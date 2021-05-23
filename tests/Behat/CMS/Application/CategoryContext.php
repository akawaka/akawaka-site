<?php

declare(strict_types=1);

namespace App\Tests\Behat\CMS\Application;

use Behat\Gherkin\Node\TableNode;
use App\CMS\Application\Article\Gateway\CreateCategory;
use App\CMS\Application\Article\Gateway\FindCategoryById;
use App\CMS\Application\Article\Gateway\FindCategoryBySlug;
use App\CMS\Application\Article\Gateway\FindCategories;
use App\CMS\Application\Article\Gateway\RemoveCategory;
use App\CMS\Application\Article\Gateway\UpdateCategory;
use Behat\Behat\Context\Context;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class CategoryContext implements Context
{
    private array $requests = [];

    private array $responses = [];

    public function __construct(
        private CreateCategory\Gateway $createCategoryGateway,
        private FindCategoryById\Gateway $findCategoryByIdGateway,
        private FindCategoryBySlug\Gateway $findCategoryBySlugGateway,
        private FindCategories\Gateway $findCategoriesGateway,
        private RemoveCategory\Gateway $removeCategoryGateway,
        private UpdateCategory\Gateway $updateCategoryGateway,
    ) {
    }

    /**
     * @Given I want to create a category:
     */
    public function iWantToCreateACategory(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreateCategory\Request::fromData($row);
        }
    }

    /**
     * @When I create this category
     */
    public function iCreateThisCategory()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createCategoryGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, CreateCategory\Response::class);
    }

    /**
     * @Then I should be able to find my category with his identifier
     */
    public function iShouldBeAbleToFindMyCategoryWithHisIdentifier()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findCategoryByIdGateway)(FindCategoryById\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindCategoryById\Response::class);
        }
    }

    /**
     * @Then I should be able to find my category with his slug
     */
    public function iShouldBeAbleToFindMyCategoryWithHisSlug()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findCategoryBySlugGateway)(FindCategoryBySlug\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindCategoryBySlug\Response::class);
        }
    }

    /**
     * @Given I already have a category with slug:
     */
    public function iAlreadyHaveACategoryWithSlug(TableNode $table)
    {
        $this->requests = [];
        $this->responses = [];

        /** @var array $row */
        foreach ($table as $row) {
            $this->responses[] = ($this->findCategoryBySlugGateway)(FindCategoryBySlug\Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, FindCategoryBySlug\Response::class);
    }

    /**
     * @When I list all categories
     */
    public function iListAllCategories()
    {
        $this->responses = ($this->findCategoriesGateway)(FindCategories\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one category with slug:
     */
    public function iShouldHaveAtLeastOneCategoryWithSlug(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findCategoryByIdGateway)(FindCategoryById\Request::fromData($response));

            if ($response->getCategory()->getSlug()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getCategory()->getSlug();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my category with:
     */
    public function iUpdateMyCategoryWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge(['identifier' => $this->responses[0]->getCategory()->getId()->getValue()], $row);
            $this->responses[] = ($this->updateCategoryGateway)(UpdateCategory\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the category should be updated with:
     */
    public function theCategorieshouldBeUpdatedWith(TableNode $table)
    {
        /** @var UpdateCategory\Response $response */
        $response = $this->responses[0];

        foreach ($table as $row) {
            Assert::true($response->data()['slug'] === $row['slug']);
            Assert::true($response->data()['name'] === $row['name']);
        }
    }

    /**
     * @When I remove this category
     */
    public function iRemoveThisCategory()
    {
        $this->responses[] = ($this->removeCategoryGateway)(RemoveCategory\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the category should not be found
     */
    public function theCategorieshouldNotBeFound()
    {
        try {
            ($this->findCategoryBySlugGateway)(FindCategoryBySlug\Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
