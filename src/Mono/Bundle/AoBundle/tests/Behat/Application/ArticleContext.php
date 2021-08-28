<?php

declare(strict_types=1);

namespace Mono\Tests\Bundle\AoBundle\Behat\Application;

use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\CreateArticle;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticleBySlug\Request;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\CreateSpace;
use Mono\Bundle\AoBundle\Admin\Category\Application\Gateway\CreateCategory;
use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\CreateAuthor;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticleById;
use Mono\Bundle\AoBundle\Admin\Category\Application\Gateway\FindCategoryBySlug;
use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\FindAuthorBySlug;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticleBySlug;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticles;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\DeleteArticle;
use Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\UpdateArticle;
use Mono\Bundle\AoBundle\Admin\Space\Application\Gateway\FindSpaceByCode;
use Behat\Behat\Context\Context;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class ArticleContext implements Context
{
    private array $space = [];

    private array $category = [];

    private array $author = [];

    private array $requests = [];

    private array $responses = [];

    public function __construct(
        private CreateSpace\Gateway $createSpaceGateway,
        private CreateCategory\Gateway $createCategoryGateway,
        private CreateAuthor\Gateway $createAuthorGateway,
        private FindSpaceByCOde\Gateway $findSpaceByCode,
        private CreateArticle\Gateway $createArticleGateway,
        private FindArticleById\Gateway $findArticleByIdGateway,
        private FindCategoryBySlug\Gateway $findCategoryBySlugGateway,
        private FindAuthorBySlug\Gateway $findAuthorBySlugGateway,
        private FindArticleBySlug\Gateway $findArticleBySlugGateway,
        private FindArticles\Gateway $findArticlesGateway,
        private DeleteArticle\Gateway $deleteArticleGateway,
        private UpdateArticle\Gateway $updateArticleGateway,
    ) {
    }

    /**
     * @Given I have a space named :space with a category named :category and an author named :author
     *
     * @param mixed $space
     * @param mixed $category
     * @param mixed $author
     */
    public function iHaveASpaceNamedWithCategoryNamed($space, $category, $author)
    {
        try {
            $this->space = ($this->findSpaceByCode)(FindSpaceByCode\Request::fromData([
                'code' => $space,
            ]))->data();
        } catch (GatewayException $exception) {
            $this->space = ($this->createSpaceGateway)(CreateSpace\Request::fromData([
                'name' => $space,
                'code' => $space,
            ]))->data();
        }

        try {
            $this->category = ($this->findCategoryBySlugGateway)(FindCategoryBySlug\Request::fromData([
                'slug' => $category,
            ]))->data();
        } catch (GatewayException $exception) {
            $this->category = ($this->createCategoryGateway)(CreateCategory\Request::fromData([
                'name' => $category,
                'slug' => $category,
            ]))->data();
        }

        try {
            $this->author = ($this->findAuthorBySlugGateway)(FindAuthorBySlug\Request::fromData([
                'slug' => $author,
            ]))->data();
        } catch (GatewayException $exception) {
            $this->author = ($this->createAuthorGateway)(CreateAuthor\Request::fromData([
                'name' => $author,
                'slug' => $author,
            ]))->data();
        }
    }

    /**
     * @Given I want to create an article
     */
    public function iWantToCreateAArticle(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $data = array_merge(
                $row,
                [
                    'spaces' => [$this->space['identifier']],
                    'categories' => [$this->category['identifier']],
                    'authors' => [$this->author['identifier']],
                ]
            );

            $this->requests[] = CreateArticle\Request::fromData($data);
        }
    }

    /**
     * @When I create this article
     */
    public function iCreateThisArticle()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createArticleGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, \Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\CreateArticle\Response::class);
    }

    /**
     * @Then I should be able to find my article with his identifier
     */
    public function iShouldBeAbleToFindMyArticleWithHisIdentifier()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findArticleByIdGateway)(FindArticleById\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindArticleById\Response::class);
        }
    }

    /**
     * @Then I should be able to find my article with his slug :slug
     */
    public function iShouldBeAbleToFindMyArticleWithHisSlug(string $slug)
    {
        foreach ($this->responses as $response) {
            $result = ($this->findArticleBySlugGateway)(FindArticleBySlug\Request::fromData([
                'slug' => $slug,
            ]));
            Assert::isInstanceOf($result, FindArticleBySlug\Response::class);
        }
    }

    /**
     * @Given I already have an article with slug
     */
    public function iAlreadyHaveAArticleWithSlug(TableNode $table)
    {
        $this->requests = [];
        $this->responses = [];

        /** @var array $row */
        foreach ($table as $row) {
            $this->responses[] = ($this->findArticleBySlugGateway)(Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, FindArticleBySlug\Response::class);
    }

    /**
     * @When I list all articles
     */
    public function iListAllArticles()
    {
        $this->responses = ($this->findArticlesGateway)(\Mono\Bundle\AoBundle\Admin\Article\Application\Gateway\FindArticles\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one article with slug
     */
    public function iShouldHaveAtLeastOneArticleWithSlug(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findArticleByIdGateway)(FindArticleById\Request::fromData($response));

            if ($response->getArticle()->getSlug()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getArticle()->getSlug();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my article with
     */
    public function iUpdateMyArticleWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge([
                'identifier' => $this->responses[0]->getArticle()->getId()->getValue(),
                'categories' => [$this->category['identifier']],
                'spaces' => $this->responses[0]->getArticle()->getSpaces()->map(function ($space) {
                    return $space['id'];
                })->toArray(),
                'authors' => [$this->author['identifier']],
            ], $row);

            $this->responses[] = ($this->updateArticleGateway)(UpdateArticle\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the article should be updated with
     */
    public function theArticleshouldBeUpdatedWith(TableNode $table)
    {
        foreach ($table as $row) {
            $response = ($this->findArticleBySlugGateway)(FindArticleBySlug\Request::fromData($row));

            Assert::true($response->data()['slug'] === $row['slug']);
            Assert::true($response->data()['name'] === $row['name']);
        }
    }

    /**
     * @When I delete this article
     */
    public function iDeleteThisArticle()
    {
        $this->responses[] = ($this->deleteArticleGateway)(DeleteArticle\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the article should not be found
     */
    public function theArticleshouldNotBeFound()
    {
        try {
            ($this->findArticleBySlugGateway)(Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
