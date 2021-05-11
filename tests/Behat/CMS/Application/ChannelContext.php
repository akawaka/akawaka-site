<?php

declare(strict_types=1);

namespace App\Tests\Behat\CMS\Application;

use Behat\Gherkin\Node\TableNode;
use Mono\Component\Channel\Application\Gateway\CloseChannel;
use App\CMS\Application\Gateway\CreateChannel;
use Mono\Component\Channel\Application\Gateway\FindChannelById;
use Mono\Component\Channel\Application\Gateway\FindChannelByCode;
use Mono\Component\Channel\Application\Gateway\FindChannels;
use Mono\Component\Channel\Application\Gateway\PublishChannel;
use Mono\Component\Channel\Application\Gateway\RemoveChannel;
use Mono\Component\Channel\Application\Gateway\UpdateChannel;
use Behat\Behat\Context\Context;
use Mono\Component\Channel\Domain\Enum\StatusEnum;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class ChannelContext implements Context
{
    private array $requests = [];

    private array $responses = [];

    private CloseChannel\Gateway $closeChannelGateway;

    private CreateChannel\Gateway $createChannelGateway;

    private FindChannelById\Gateway $findChannelByIdGateway;

    private FindChannelByCode\Gateway $findChannelByCodeGateway;

    private FindChannels\Gateway $findChannelsGateway;

    private PublishChannel\Gateway $publishChannelGateway;

    private RemoveChannel\Gateway $removeChannelGateway;

    private UpdateChannel\Gateway $updateChannelGateway;

    public function __construct(
        CloseChannel\Gateway $closeChannelGateway,
        CreateChannel\Gateway $createChannelGateway,
        FindChannelById\Gateway $findChannelByIdGateway,
        FindChannelByCode\Gateway $findChannelByCodeGateway,
        FindChannels\Gateway $findChannelsGateway,
        PublishChannel\Gateway $publishChannelGateway,
        RemoveChannel\Gateway $removeChannelGateway,
        UpdateChannel\Gateway $updateChannelGateway,
    ) {
        $this->closeChannelGateway = $closeChannelGateway;
        $this->createChannelGateway = $createChannelGateway;
        $this->findChannelByIdGateway = $findChannelByIdGateway;
        $this->findChannelByCodeGateway = $findChannelByCodeGateway;
        $this->findChannelsGateway = $findChannelsGateway;
        $this->publishChannelGateway = $publishChannelGateway;
        $this->removeChannelGateway = $removeChannelGateway;
        $this->updateChannelGateway = $updateChannelGateway;
    }

    /**
     * @Given I want to create a channel:
     */
    public function iWantToCreateAChannel(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreateChannel\Request::fromData($row);
        }
    }

    /**
     * @When I create this channel
     */
    public function iCreateThisChannel()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createChannelGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, CreateChannel\Response::class);
    }

    /**
     * @Then I should be able to find my channel with his identifier
     */
    public function iShouldBeAbleToFindMyChannelWithHisIdentifier()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findChannelByIdGateway)(FindChannelById\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindChannelById\Response::class);
        }
    }

    /**
     * @Then I should be able to find my channel with his code
     */
    public function iShouldBeAbleToFindMyChannelWithHisCode()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findChannelByCodeGateway)(FindChannelByCode\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindChannelByCode\Response::class);
        }
    }

    /**
     * @Given I already have a channel with code:
     */
    public function iAlreadyHaveAChannelWithCode(TableNode $table)
    {
        $this->requests = [];
        $this->responses = [];

        /** @var array $row */
        foreach ($table as $row) {
            $this->responses[] = ($this->findChannelByCodeGateway)(FindChannelByCode\Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, FindChannelByCode\Response::class);
    }

    /**
     * @When I list all channels
     */
    public function iListAllChannels()
    {
        $this->responses = ($this->findChannelsGateway)(FindChannels\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one channel with code:
     */
    public function iShouldHaveAtLeastOneChannelWithCode(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findChannelByIdGateway)(FindChannelById\Request::fromData($response));

            if ($response->getChannel()->getCode()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getChannel()->getCode();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my channel with:
     */
    public function iUpdateMyChannelWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge(['identifier' => $this->responses[0]->getChannel()->getId()->getValue()], $row);
            $this->responses[] = ($this->updateChannelGateway)(UpdateChannel\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the channel should be updated with:
     */
    public function theChannelShouldBeUpdatedWith(TableNode $table)
    {
        /** @var UpdateChannel\Response $response */
        $response = $this->responses[0];

        foreach ($table as $row) {
            Assert::true($response->data()['code'] === $row['code']);
            Assert::true($response->data()['name'] === $row['name']);
            Assert::true($response->data()['url'] === $row['url']);
            Assert::true($response->data()['description'] === $row['description']);
            Assert::notNull($response->data()['lastUpdate']);
        }
    }

    /**
     * @When I publish this channel
     */
    public function iPublishThisChannel()
    {
        $this->responses[] = ($this->publishChannelGateway)(PublishChannel\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the channel should be published
     */
    public function theChannelShouldBePublished()
    {
        $channel = ($this->findChannelByCodeGateway)(FindChannelByCode\Request::fromData(
            $this->responses[0]->data()
        ));

        Assert::true(StatusEnum::PUBLISHED === $channel->data()['status']);
    }

    /**
     * @When I close this channel
     */
    public function iCloseThisChannel()
    {
        $this->responses[] = ($this->closeChannelGateway)(CloseChannel\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the channel should be unpublished
     */
    public function theChannelShouldBeUnpublished()
    {
        $channel = ($this->findChannelByCodeGateway)(FindChannelByCode\Request::fromData(
            $this->responses[0]->data()
        ));

        Assert::true(StatusEnum::CLOSED === $channel->data()['status']);
    }

    /**
     * @When I remove this channel
     */
    public function iRemoveThisChannel()
    {
        $this->responses[] = ($this->removeChannelGateway)(RemoveChannel\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the channel should not be found
     */
    public function theChannelShouldNotBeFound()
    {
        try {
            ($this->findChannelByCodeGateway)(FindChannelByCode\Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
