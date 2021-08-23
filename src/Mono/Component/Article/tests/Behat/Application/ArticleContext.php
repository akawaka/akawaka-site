<?php

declare(strict_types=1);

namespace Mono\Tests\Component\Article\Behat\Application;

use Behat\Gherkin\Node\TableNode;
use Mono\Component\Article\Application\Gateway\Article\CreateArticle;
use Mono\Component\Article\Application\Gateway\Category\CreateCategory;
use Mono\Component\Article\Application\Gateway\Author\CreateAuthor;
use Mono\Component\Article\Application\Gateway\Article\FindArticleById;
use Mono\Component\Article\Application\Gateway\Category\FindCategoryBySlug;
use Mono\Component\Article\Application\Gateway\Author\FindAuthorBySlug;
use Mono\Component\Article\Application\Gateway\Article\FindArticleBySlug;
use Mono\Component\Article\Application\Gateway\Article\FindArticles;
use Mono\Component\Article\Application\Gateway\Article\DeleteArticle;
use Mono\Component\Article\Application\Gateway\Article\UpdateArticle;
use Behat\Behat\Context\Context;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class ArticleContext implements Context
{
    public function __construct(
        private CreateCategory\Gateway $createCategoryGateway,
        private CreateArticle\Gateway $createArticleGateway,
        private CreateAuthor\Gateway $createAuthorGateway,
        private FindArticleById\Gateway $findArticleByIdGateway,
        private FindCategoryBySlug\Gateway $findCategoryBySlugGateway,
        private FindAuthorBySlug\Gateway $findAuthorBySlugGateway,
        private FindArticleBySlug\Gateway $findArticleBySlugGateway,
        private FindArticles\Gateway $findArticlesGateway,
        private DeleteArticle\Gateway $deleteArticleGateway,
        private UpdateArticle\Gateway $updateArticleGateway,
        private array $category = [],
        private array $author = [],
        private array $requests = [],
        private array $responses = [],
    ) {
    }

    /**
     * @Given I have a category named :category and an author named :author
     *
     * @param mixed $category
     */
    public function iHaveACategoryNamed(string $category, string $author): void
    {
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

        Assert::allIsInstanceOf($this->responses, CreateArticle\Response::class);
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
            $this->responses[] = ($this->findArticleBySlugGateway)(FindArticleBySlug\Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, FindArticleBySlug\Response::class);
    }

    /**
     * @When I list all articles
     */
    public function iListAllArticles()
    {
        $this->responses = ($this->findArticlesGateway)(FindArticles\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one article with slug
     */
    public function iShouldHaveAtLeastOneArticleWithSlug(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findArticleBySlugGateway)(FindArticleBySlug\Request::fromData($response));

            if ($response->getArticle()->getSlug()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getArticle()->getSlug();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my article with:
     */
    public function iUpdateMyArticleWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge([
                'identifier' => $this->responses[0]->getArticle()->getId()->getValue(),
                'categories' => [$this->category['identifier']],
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
            ($this->findArticleBySlugGateway)(FindArticleBySlug\Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
