<?php

declare(strict_types=1);

namespace App\Tests\Behat\CMS\Application;

use Behat\Gherkin\Node\TableNode;
use Mono\Component\Space\Application\Gateway\CloseSpace;
use App\CMS\Application\Gateway\CreateSpace;
use Mono\Component\Space\Application\Gateway\FindSpaceById;
use Mono\Component\Space\Application\Gateway\FindSpaceByCode;
use Mono\Component\Space\Application\Gateway\FindSpaces;
use Mono\Component\Space\Application\Gateway\PublishSpace;
use Mono\Component\Space\Application\Gateway\RemoveSpace;
use Mono\Component\Space\Application\Gateway\UpdateSpace;
use Behat\Behat\Context\Context;
use Mono\Component\Space\Domain\Enum\StatusEnum;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class SpaceContext implements Context
{
    private array $requests = [];

    private array $responses = [];

    private CloseSpace\Gateway $closeSpaceGateway;

    private CreateSpace\Gateway $createSpaceGateway;

    private FindSpaceById\Gateway $findSpaceByIdGateway;

    private FindSpaceByCode\Gateway $findSpaceByCodeGateway;

    private FindSpaces\Gateway $findSpacesGateway;

    private PublishSpace\Gateway $publishSpaceGateway;

    private RemoveSpace\Gateway $removeSpaceGateway;

    private UpdateSpace\Gateway $updateSpaceGateway;

    public function __construct(
        CloseSpace\Gateway $closeSpaceGateway,
        CreateSpace\Gateway $createSpaceGateway,
        FindSpaceById\Gateway $findSpaceByIdGateway,
        FindSpaceByCode\Gateway $findSpaceByCodeGateway,
        FindSpaces\Gateway $findSpacesGateway,
        PublishSpace\Gateway $publishSpaceGateway,
        RemoveSpace\Gateway $removeSpaceGateway,
        UpdateSpace\Gateway $updateSpaceGateway,
    ) {
        $this->closeSpaceGateway = $closeSpaceGateway;
        $this->createSpaceGateway = $createSpaceGateway;
        $this->findSpaceByIdGateway = $findSpaceByIdGateway;
        $this->findSpaceByCodeGateway = $findSpaceByCodeGateway;
        $this->findSpacesGateway = $findSpacesGateway;
        $this->publishSpaceGateway = $publishSpaceGateway;
        $this->removeSpaceGateway = $removeSpaceGateway;
        $this->updateSpaceGateway = $updateSpaceGateway;
    }

    /**
     * @Given I want to create a space:
     */
    public function iWantToCreateASpace(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreateSpace\Request::fromData($row);
        }
    }

    /**
     * @When I create this space
     */
    public function iCreateThisSpace()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createSpaceGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, CreateSpace\Response::class);
    }

    /**
     * @Then I should be able to find my space with his identifier
     */
    public function iShouldBeAbleToFindMySpaceWithHisIdentifier()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findSpaceByIdGateway)(FindSpaceById\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindSpaceById\Response::class);
        }
    }

    /**
     * @Then I should be able to find my space with his code
     */
    public function iShouldBeAbleToFindMySpaceWithHisCode()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findSpaceByCodeGateway)(FindSpaceByCode\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindSpaceByCode\Response::class);
        }
    }

    /**
     * @Given I already have a space with code:
     */
    public function iAlreadyHaveASpaceWithCode(TableNode $table)
    {
        $this->requests = [];
        $this->responses = [];

        /** @var array $row */
        foreach ($table as $row) {
            $this->responses[] = ($this->findSpaceByCodeGateway)(FindSpaceByCode\Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, FindSpaceByCode\Response::class);
    }

    /**
     * @When I list all spaces
     */
    public function iListAllSpaces()
    {
        $this->responses = ($this->findSpacesGateway)(FindSpaces\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one space with code:
     */
    public function iShouldHaveAtLeastOneSpaceWithCode(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findSpaceByIdGateway)(FindSpaceById\Request::fromData($response));

            if ($response->getSpace()->getCode()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getSpace()->getCode();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my space with:
     */
    public function iUpdateMySpaceWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge(['identifier' => $this->responses[0]->getSpace()->getId()->getValue()], $row);
            $this->responses[] = ($this->updateSpaceGateway)(UpdateSpace\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the space should be updated with:
     */
    public function theSpaceShouldBeUpdatedWith(TableNode $table)
    {
        /** @var UpdateSpace\Response $response */
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
     * @When I publish this space
     */
    public function iPublishThisSpace()
    {
        $this->responses[] = ($this->publishSpaceGateway)(PublishSpace\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the space should be published
     */
    public function theSpaceShouldBePublished()
    {
        $space = ($this->findSpaceByCodeGateway)(FindSpaceByCode\Request::fromData(
            $this->responses[0]->data()
        ));

        Assert::true(StatusEnum::PUBLISHED === $space->data()['status']);
    }

    /**
     * @When I close this space
     */
    public function iCloseThisSpace()
    {
        $this->responses[] = ($this->closeSpaceGateway)(CloseSpace\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the space should be unpublished
     */
    public function theSpaceShouldBeUnpublished()
    {
        $space = ($this->findSpaceByCodeGateway)(FindSpaceByCode\Request::fromData(
            $this->responses[0]->data()
        ));

        Assert::true(StatusEnum::CLOSED === $space->data()['status']);
    }

    /**
     * @When I remove this space
     */
    public function iRemoveThisSpace()
    {
        $this->responses[] = ($this->removeSpaceGateway)(RemoveSpace\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the space should not be found
     */
    public function theSpaceShouldNotBeFound()
    {
        try {
            ($this->findSpaceByCodeGateway)(FindSpaceByCode\Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
