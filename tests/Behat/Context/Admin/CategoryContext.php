<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context\Admin;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use App\Context\Admin\Category\Application\Gateway\CreateCategory;
use App\Context\Admin\Category\Application\Gateway\CreateCategory\Request;
use App\Context\Admin\Category\Application\Gateway\CreateCategory\Response;
use App\Context\Admin\Category\Application\Gateway\DeleteCategory;
use App\Context\Admin\Category\Application\Gateway\BrowseCategories;
use App\Context\Admin\Category\Application\Gateway\FindCategoryById;
use App\Context\Admin\Category\Application\Gateway\FindCategoryBySlug;
use App\Context\Admin\Category\Application\Gateway\UpdateCategory;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class CategoryContext implements Context
{
    public function __construct(
        private CreateCategory\Gateway $createCategoryGateway,
        private FindCategoryById\Gateway $findCategoryByIdGateway,
        private FindCategoryBySlug\Gateway $findCategoryBySlugGateway,
        private BrowseCategories\Gateway $findCategoriesGateway,
        private DeleteCategory\Gateway $deleteCategoryGateway,
        private UpdateCategory\Gateway $updateCategoryGateway,
        private array $requests = [],
        private array $responses = []
    ) {
    }

    /**
     * @Given I want to create a category
     */
    public function iWantToCreateACategory(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = Request::fromData($row);
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

        Assert::allIsInstanceOf($this->responses, Response::class);
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
     * @Then I should be able to find my category with his slug :slug
     */
    public function iShouldBeAbleToFindMyCategoryWithHisSlug(string $slug)
    {
        foreach ($this->responses as $response) {
            $result = ($this->findCategoryBySlugGateway)(FindCategoryBySlug\Request::fromData([
                'slug' => $slug,
            ]));
            Assert::isInstanceOf($result, FindCategoryBySlug\Response::class);
        }
    }

    /**
     * @Given I already have a category with slug
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
        $this->responses = ($this->findCategoriesGateway)(BrowseCategories\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one category with slug
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
     * @When I update my category with
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
     * @Then the category should be updated with
     */
    public function theCategorieshouldBeUpdatedWith(TableNode $table)
    {
        foreach ($table as $row) {
            $response = ($this->findCategoryBySlugGateway)(FindCategoryBySlug\Request::fromData($row));

            Assert::true($response->data()['slug'] === $row['slug']);
            Assert::true($response->data()['name'] === $row['name']);
        }
    }

    /**
     * @When I delete this category
     */
    public function iDeleteThisCategory()
    {
        $this->responses[] = ($this->deleteCategoryGateway)(DeleteCategory\Request::fromData($this->responses[0]->data()));

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
            Assert::true($exception instanceof GatewayException);
        }
    }
}
