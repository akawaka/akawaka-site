<?php

declare(strict_types=1);

namespace App\Tests\Behat\Cms\Application;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Black\Component\Channel\Application\Gateway\FindChannelByCode;
use App\Cms\Application\Gateway\CreateChannel;
use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Core\Application\Gateway\GatewayException;
use Black\Component\Page\Application\Gateway\UnpublishPage;
use Black\Component\Page\Application\Gateway\FindPageById;
use Black\Component\Page\Application\Gateway\FindPageBySlug;
use Black\Component\Page\Application\Gateway\FindPages;
use Black\Component\Page\Application\Gateway\PublishPage;
use Black\Component\Page\Application\Gateway\RemovePage;
use Black\Component\Page\Application\Gateway\UpdatePage;
use App\Cms\Application\Gateway\CreatePage;
use Behat\Behat\Context\Context;
use Black\Component\Page\Domain\Enum\StatusEnum;
use Webmozart\Assert\Assert;

final class PageContext implements Context
{
    private ?ChannelInterface $channel;

    private array $requests = [];

    private array $responses = [];

    private FindChannelByCode\Gateway $findChannelByCodeGateway;

    private CreateChannel\Gateway $createChannelGateway;

    private UnpublishPage\Gateway $unpublishPageGateway;

    private CreatePage\Gateway $createPageGateway;

    private FindPageById\Gateway $findPageByIdGateway;

    private FindPageBySlug\Gateway $findPageBySlugGateway;

    private FindPages\Gateway $findPagesGateway;

    private PublishPage\Gateway $publishPageGateway;

    private RemovePage\Gateway $removePageGateway;

    private UpdatePage\Gateway $updatePageGateway;


    public function __construct(
        UnpublishPage\Gateway $unpublishPageGateway,
        FindChannelByCode\Gateway $findChannelByCodeGateway,
        CreateChannel\Gateway $createChannelGateway,
        CreatePage\Gateway $createPageGateway,
        FindPageById\Gateway $findPageByIdGateway,
        FindPageBySlug\Gateway $findPageBySlugGateway,
        FindPages\Gateway $findPagesGateway,
        PublishPage\Gateway $publishPageGateway,
        RemovePage\Gateway $removePageGateway,
        UpdatePage\Gateway $updatePageGateway,
    ) {
        $this->createChannelGateway = $createChannelGateway;
        $this->findChannelByCodeGateway = $findChannelByCodeGateway;
        $this->createPageGateway = $createPageGateway;
        $this->unpublishPageGateway = $unpublishPageGateway;
        $this->findPageByIdGateway = $findPageByIdGateway;
        $this->findPageBySlugGateway = $findPageBySlugGateway;
        $this->findPagesGateway = $findPagesGateway;
        $this->publishPageGateway = $publishPageGateway;
        $this->removePageGateway = $removePageGateway;
        $this->updatePageGateway = $updatePageGateway;

        $this->channel = null;
    }

    /**
     * @Given I have a channel named :channel
     */
    public function iHaveAChannelNamed(string $channel)
    {
        try {
            $channel = ($this->findChannelByCodeGateway)(FindChannelByCode\Request::fromData([
                'code' => $channel
            ]));
        } catch (GatewayException $exception) {
            $channel = ($this->createChannelGateway)(CreateChannel\Request::fromData([
                'code' => "default",
                'name' => "default"
            ]));
        }

        $this->channel = $channel->getChannel();
    }

    /**
     * @Given I want to create a page for this channel:
     */
    public function iWantToCreateAPageForMyChannel(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreatePage\Request::fromData(array_merge([
                'channel' => $this->channel->getId()->getValue(),
            ], $row));
        }
    }

    /**
     * @When I create this page for my channel
     */
    public function iCreateThisPageForMyChannel()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createPageGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, CreatePage\Response::class);
    }

    /**
     * @Given I want to create a page:
     */
    public function iWantToCreateAPage(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreatePage\Request::fromData($row);
        }
    }

    /**
     * @When I create this page
     */
    public function iCreateThisPage()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createPageGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, CreatePage\Response::class);
    }

    /**
     * @Then I should be able to find my page with his identifier
     */
    public function iShouldBeAbleToFindMyPageWithHisIdentifier()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findPageByIdGateway)(FindPageById\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindPageById\Response::class);
        }
    }

    /**
     * @Then I should be able to find my page with his slug
     */
    public function iShouldBeAbleToFindMyPageWithHisSlug()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindPageBySlug\Response::class);
        }
    }

    /**
     * @Given I already have a page with slug:
     */
    public function iAlreadyHaveAPageWithSlug(TableNode $table)
    {
        $this->requests = [];
        $this->responses = [];

        /** @var array $row */
        foreach ($table as $row) {
            $this->responses[] = ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, FindPageBySlug\Response::class);
    }

    /**
     * @When I list all pages
     */
    public function iListAllPages()
    {
        $this->responses = ($this->findPagesGateway)(FindPages\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one page with slug:
     */
    public function iShouldHaveAtLeastOnePageWithSlug(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findPageByIdGateway)(FindPageById\Request::fromData($response));

            if ($response->getPage()->getSlug()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getPage()->getSlug();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my page with:
     */
    public function iUpdateMyPageWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge(['identifier' => $this->responses[0]->getPage()->getId()->getValue()], $row);
            $this->responses[] = ($this->updatePageGateway)(UpdatePage\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the page should be updated with:
     */
    public function thePageShouldBeUpdatedWith(TableNode $table)
    {
        /** @var UpdatePage\Response $response */
        $response = $this->responses[0];

        foreach ($table as $row) {
            Assert::true($response->data()['slug'] === $row['slug']);
            Assert::true($response->data()['name'] === $row['name']);
            Assert::true($response->data()['content'] === $row['content']);
            Assert::notNull($response->data()['lastUpdate']);
        }
    }

    /**
     * @When I publish this page
     */
    public function iPublishThisPage()
    {
        $this->responses[] = ($this->publishPageGateway)(PublishPage\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the page should be published
     */
    public function thePageShouldBePublished()
    {
        $Page = ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData(
            $this->responses[0]->data()
        ));

        Assert::true($Page->data()['status'] === StatusEnum::PUBLISHED);
    }

    /**
     * @When I unpublish this page
     */
    public function iUnpublishThisPage()
    {
        $this->responses[] = ($this->unpublishPageGateway)(UnpublishPage\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the page should be unpublished
     */
    public function thePageShouldBeUnpublished()
    {
        $Page = ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData(
            $this->responses[0]->data()
        ));

        Assert::true($Page->data()['status'] === StatusEnum::DRAFT);
    }

    /**
     * @When I remove this page
     */
    public function iRemoveThisPage()
    {
        $this->responses[] = ($this->removePageGateway)(RemovePage\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the page should not be found
     */
    public function thePageShouldNotBeFound()
    {
        try {
            ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true(get_class($exception) === GatewayException::class);
        }
    }
}