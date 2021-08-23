<?php

declare(strict_types=1);

namespace Mono\Tests\Component\Page\Behat\Application;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Component\Page\Application\Gateway\CreatePage;
use Mono\Component\Page\Application\Gateway\UpdatePage;
use Mono\Component\Page\Application\Gateway\DeletePage;
use Mono\Component\Page\Application\Gateway\FindPageById;
use Mono\Component\Page\Application\Gateway\FindPageBySlug;
use Mono\Component\Page\Application\Gateway\FindPages;
use Webmozart\Assert\Assert;

final class PageContext implements Context
{
    public function __construct(
        private CreatePage\Gateway $createPageGateway,
        private FindPageById\Gateway $findPageByIdGateway,
        private FindPageBySlug\Gateway $findPageBySlugGateway,
        private FindPages\Gateway $findPagesGateway,
        private DeletePage\Gateway $deletePageGateway,
        private UpdatePage\Gateway $updatePageGateway,
        private array $requests = [],
        private array $responses = []
    ) {
    }

    /**
     * @Given I want to create a page
     */
    public function iWantToCreateAPage(TableNode $table): void
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreatePage\Request::fromData($row);
        }
    }

    /**
     * @When I create this page
     */
    public function iCreateThisPage(): void
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createPageGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, CreatePage\Response::class);
    }

    /**
     * @Then I should be able to find my page with his identifier
     */
    public function iShouldBeAbleToFindMyPageWithHisIdentifier(): void
    {
        foreach ($this->responses as $response) {
            $result = ($this->findPageByIdGateway)(FindPageById\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindPageById\Response::class);
        }
    }

    /**
     * @Then I should be able to find my page with his slug :slug
     */
    public function iShouldBeAbleToFindMyPageWithHisSlug(string $slug): void
    {
        $result = ($this->findPageBySlugGateway)(FindPageBySlug\Request::fromData([
            'slug' => $slug,
        ]));
        Assert::isInstanceOf($result, FindPageBySlug\Response::class);
    }

    /**
     * @Given I already have a page with slug
     */
    public function iAlreadyHaveAPageWithSlug(TableNode $table): void
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
    public function iListAllPages(): void
    {
        $this->responses = ($this->findPagesGateway)(FindPages\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one page with slug
     */
    public function iShouldHaveAtLeastOnePageWithSlug(TableNode $table): void
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
     * @When I update my page with
     */
    public function iUpdateMyPageWith(TableNode $table): void
    {
        foreach ($table as $row) {
            $data = array_merge([
                'identifier' => $this->responses[0]->getPage()->getId()->getValue(),
            ], $row);
            $this->responses[] = ($this->updatePageGateway)(UpdatePage\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the page should be updated with
     */
    public function thePageShouldBeUpdatedWith(TableNode $table): void
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
     * @When I remove this page
     */
    public function iRemoveThisPage(): void
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
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
