<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Admin;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\CreatePage;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\CreatePage\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\DeletePage;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\FindPageById;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\FindPageById\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\FindPageBySlug;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\BrowsePages;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\PublishPage;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\UnpublishPage;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Gateway\UpdatePage;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\CreateSpace as BaseCreateSpace;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Gateway\FindSpaceByCode as BaseFindSpaceByCode;
use App\Context\Admin\Space\Application\Gateway\CreateSpace;
use App\Context\Admin\Space\Application\Gateway\FindSpaceByCode;
use Mono\Bundle\AoBundle\Shared\Domain\Enum\PageStatus;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class PageContext implements Context
{
    public function __construct(
        private UnpublishPage\Gateway $unpublishPageGateway,
        private FindSpaceByCode\Gateway $findSpaceByCodeGateway,
        private CreateSpace\Gateway $createSpaceGateway,
        private CreatePage\Gateway $createPageGateway,
        private FindPageById\Gateway $findPageByIdGateway,
        private FindPageBySlug\Gateway $findPageBySlugGateway,
        private BrowsePages\Gateway $findPagesGateway,
        private PublishPage\Gateway $publishPageGateway,
        private DeletePage\Gateway $deletePageGateway,
        private UpdatePage\Gateway $updatePageGateway,
        private array $space = [],
        private array $requests = [],
        private array $responses = [],
    ) {
    }

    /**
     * @Given I have a space named :space
     */
    public function iHaveASpaceNamed(string $space)
    {
        try {
            $this->space = ($this->findSpaceByCodeGateway)(BaseFindSpaceByCode\Request::fromData([
                'code' => $space,
            ]))->data();
        } catch (GatewayException $exception) {
            $this->space = ($this->createSpaceGateway)(CreateSpace\Request::fromData([
                'name' => $space,
                'code' => $space,
            ]))->data();
        }
    }

    /**
     * @Given I want to create a page for this space
     */
    public function iWantToCreateAPageForMySpace(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreatePage\Request::fromData(array_merge([
                'spaces' => [$this->space['identifier']],
            ], $row));
        }
    }

    /**
     * @When I create this page for my space
     */
    public function iCreateThisPageForMySpace()
    {
        foreach ($this->requests as $request) {
            $response = ($this->createPageGateway)($request);
            $this->responses[] = $response;
        }

        Assert::allIsInstanceOf($this->responses, Response::class);
    }

    /**
     * @Given I want to create a page
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

        Assert::allIsInstanceOf($this->responses, Response::class);
    }

    /**
     * @Then I should be able to find my page with his identifier
     */
    public function iShouldBeAbleToFindMyPageWithHisIdentifier()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findPageByIdGateway)(Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindPageById\Response::class);
        }
    }

    /**
     * @Then I should be able to find my page with his slug :slug
     */
    public function iShouldBeAbleToFindMyPageWithHisSlug(string $slug)
    {
        $result = ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData([
            'slug' => $slug,
        ]));
        Assert::isInstanceOf($result, FindPageBySlug\Response::class);
    }

    /**
     * @Given I already have a page with slug
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
        $this->responses = ($this->findPagesGateway)(BrowsePages\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one page with slug
     */
    public function iShouldHaveAtLeastOnePageWithSlug(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findPageByIdGateway)(Request::fromData($response));

            if ($response->getPage()->getSlug()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getPage()->getSlug();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my page with
     */
    public function iUpdateMyPageWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge([
                'identifier' => $this->responses[0]->getPage()->getId()->getValue(),
                'spaces' => $this->responses[0]->getPage()->getSpaces()->map(function ($space) {
                    return $space['id'];
                })->toArray(),
            ], $row);
            $this->responses[] = ($this->updatePageGateway)(UpdatePage\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the page should be updated with
     */
    public function thePageShouldBeUpdatedWith(TableNode $table)
    {
        foreach ($table as $row) {
            $response = ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData($row));

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

        Assert::true(PageStatus::PUBLISHED === $Page->data()['status']);
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

        Assert::true(PageStatus::DRAFT === $Page->data()['status']);
    }

    /**
     * @When I delete this page
     */
    public function iDeleteThisPage(): void
    {
        $this->responses[] = ($this->deletePageGateway)(DeletePage\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the page should not be found
     */
    public function thePageShouldNotBeFound(): void
    {
        try {
            ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true($exception instanceof GatewayException);
        }
    }
}
