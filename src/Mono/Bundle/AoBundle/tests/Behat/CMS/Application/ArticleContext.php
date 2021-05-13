<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Tests\Behat\CMS\Application;

use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AoBundle\CMS\Application\Gateway\CreateArticle;
use Mono\Bundle\AoBundle\CMS\Application\Gateway\CreateChannel;
use Mono\Bundle\AoBundle\CMS\Application\Gateway\CreateCategory;
use Mono\Component\Article\Application\Gateway\FindArticleById;
use Mono\Component\Article\Application\Gateway\FindCategoryBySlug;
use Mono\Component\Article\Application\Gateway\FindArticleBySlug;
use Mono\Component\Article\Application\Gateway\FindArticles;
use Mono\Component\Article\Application\Gateway\RemoveArticle;
use Mono\Component\Article\Application\Gateway\UpdateArticle;
use Mono\Component\Channel\Application\Gateway\FindChannelByCode;
use Behat\Behat\Context\Context;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class ArticleContext implements Context
{
    private array $channel = [];

    private array $category = [];

    private array $requests = [];

    private array $responses = [];

    public function __construct(
        private CreateChannel\Gateway $createChannelGateway,
        private CreateCategory\Gateway $createCategoryGateway,
        private FindChannelByCOde\Gateway $findChannelByCode,
        private CreateArticle\Gateway $createArticleGateway,
        private FindArticleById\Gateway $findArticleByIdGateway,
        private FindCategoryBySlug\Gateway $findCategoryBySlugGateway,
        private FindArticleBySlug\Gateway $findArticleBySlugGateway,
        private FindArticles\Gateway $findArticlesGateway,
        private RemoveArticle\Gateway $removeArticleGateway,
        private UpdateArticle\Gateway $updateArticleGateway,
    ) {
    }

    /**
     * @Given I have a channel named :channel with a category named :category
     *
     * @param mixed $channel
     * @param mixed $category
     */
    public function iHaveAChannelNamedWithCategoryNamed($channel, $category)
    {
        try {
            $this->channel = ($this->findChannelByCode)(FindChannelByCode\Request::fromData([
                'code' => $channel,
            ]))->data();
        } catch (GatewayException $exception) {
            $this->channel = ($this->createChannelGateway)(CreateChannel\Request::fromData([
                'name' => $channel,
                'code' => $channel,
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
    }

    /**
     * @Given I want to create a article:
     */
    public function iWantToCreateAArticle(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $data = array_merge(
                $row,
                [
                    'channels' => [$this->channel['identifier']],
                    'categories' => [$this->category['identifier']],
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
     * @Then I should be able to find my article with his slug
     */
    public function iShouldBeAbleToFindMyArticleWithHisSlug()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findArticleBySlugGateway)(FindArticleBySlug\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindArticleBySlug\Response::class);
        }
    }

    /**
     * @Given I already have a article with slug:
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
     * @Then I should have at least one article with slug:
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
     * @When I update my article with:
     */
    public function iUpdateMyArticleWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge([
                'identifier' => $this->responses[0]->getArticle()->getId()->getValue(),
                'categories' => [$this->category['identifier']],
                'channels' => $this->responses[0]->getArticle()->getChannels()->map(function (ChannelInterface $channel) {
                    return $channel->getId()->getValue();
                })->toArray(),
            ], $row);

            $this->responses[] = ($this->updateArticleGateway)(UpdateArticle\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the article should be updated with:
     */
    public function theArticleshouldBeUpdatedWith(TableNode $table)
    {
        /** @var UpdateArticle\Response $response */
        $response = $this->responses[0];

        foreach ($table as $row) {
            Assert::true($response->data()['slug'] === $row['slug']);
            Assert::true($response->data()['name'] === $row['name']);
        }
    }

    /**
     * @When I remove this article
     */
    public function iRemoveThisArticle()
    {
        $this->responses[] = ($this->removeArticleGateway)(RemoveArticle\Request::fromData($this->responses[0]->data()));

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
