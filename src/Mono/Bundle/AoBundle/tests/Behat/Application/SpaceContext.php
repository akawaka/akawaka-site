<?php

declare(strict_types=1);

namespace Mono\Tests\Bundle\AoBundle\Behat\Application;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\CloseSpace;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\CreateSpace;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\CreateSpace\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\CreateSpace\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\FindSpaceByCode;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\FindSpaceById;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\BrowseSpaces;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\PublishSpace;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\RemoveSpace;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\UpdateSpace;
use Mono\Bundle\AoBundle\Shared\Domain\Enum\SpaceStatus;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

class SpaceContext implements Context
{
    public function __construct(
        private CloseSpace\Gateway $closeSpaceGateway,
        private CreateSpace\Gateway $createSpaceGateway,
        private FindSpaceById\Gateway $findSpaceByIdGateway,
        private FindSpaceByCode\Gateway $findSpaceByCodeGateway,
        private BrowseSpaces\Gateway $findSpacesGateway,
        private PublishSpace\Gateway $publishSpaceGateway,
        private RemoveSpace\Gateway $removeSpaceGateway,
        private UpdateSpace\Gateway $updateSpaceGateway,
        private array $requests = [],
        private array $responses = [],
    ) {
    }

    /**
     * @Given I want to create a space
     */
    public function iWantToCreateASpace(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = Request::fromData($row);
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

        Assert::allIsInstanceOf($this->responses, Response::class);
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
     * @Then I should be able to find my space with his code :code
     */
    public function iShouldBeAbleToFindMySpaceWithHisCode(string $code)
    {
        foreach ($this->responses as $response) {
            $result = ($this->findSpaceByCodeGateway)(FindSpaceByCode\Request::fromData([
                'code' => $code,
            ]));
            Assert::isInstanceOf($result, FindSpaceByCode\Response::class);
        }
    }

    /**
     * @Given I already have a space with code
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
        $this->responses = ($this->findSpacesGateway)(BrowseSpaces\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one space with code
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
     * @When I update my space with
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
     * @Then the space should be updated with
     */
    public function theSpaceShouldBeUpdatedWith(TableNode $table)
    {
        foreach ($table as $row) {
            $response = ($this->findSpaceByCodeGateway)(FindSpaceByCode\Request::fromData($row));

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

        Assert::true(SpaceStatus::PUBLISHED === $space->data()['status']);
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

        Assert::true(SpaceStatus::CLOSED === $space->data()['status']);
    }

    /**
     * @When I delete this space
     */
    public function iDeleteThisSpace()
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
            Assert::true($exception instanceof GatewayException);
        }
    }
}
