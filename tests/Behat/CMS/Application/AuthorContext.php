<?php

declare(strict_types=1);

namespace App\Tests\Behat\CMS\Application;

use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\CreateAuthor;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorById;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthorBySlug;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthors;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\DeleteAuthor;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\UpdateAuthor;
use Behat\Behat\Context\Context;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class AuthorContext implements Context
{
    public function __construct(
        private CreateAuthor\Gateway $createAuthorGateway,
        private FindAuthorById\Gateway $findAuthorByIdGateway,
        private FindAuthorBySlug\Gateway $findAuthorBySlugGateway,
        private FindAuthors\Gateway $findAuthorsGateway,
        private DeleteAuthor\Gateway $deleteAuthorGateway,
        private UpdateAuthor\Gateway $updateAuthorGateway,
        private array $requests = [],
        private array $responses = [],
    ) {
    }

    /**
     * @Given I want to create an author
     */
    public function iWantToCreateAAuthor(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreateAuthor\Request::fromData($row);
        }
    }

    /**
     * @When I create this author
     */
    public function iCreateThisAuthor()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createAuthorGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, CreateAuthor\Response::class);
    }

    /**
     * @Then I should be able to find my author with his identifier
     */
    public function iShouldBeAbleToFindMyAuthorWithHisIdentifier()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findAuthorByIdGateway)(FindAuthorById\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindAuthorById\Response::class);
        }
    }

    /**
     * @Then I should be able to find my author with his slug :slug
     */
    public function iShouldBeAbleToFindMyAuthorWithHisSlug(string $slug)
    {
        foreach ($this->responses as $response) {
            $result = ($this->findAuthorBySlugGateway)(FindAuthorBySlug\Request::fromData([
                'slug' => $slug,
            ]));
            Assert::isInstanceOf($result, FindAuthorBySlug\Response::class);
        }
    }

    /**
     * @Given I already have an author with slug
     */
    public function iAlreadyHaveAAuthorWithSlug(TableNode $table)
    {
        $this->requests = [];
        $this->responses = [];

        /** @var array $row */
        foreach ($table as $row) {
            $this->responses[] = ($this->findAuthorBySlugGateway)(FindAuthorBySlug\Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, FindAuthorBySlug\Response::class);
    }

    /**
     * @When I list all authors
     */
    public function iListAllAuthors()
    {
        $this->responses = ($this->findAuthorsGateway)(FindAuthors\Request::fromData())->data();
        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one author with slug
     */
    public function iShouldHaveAtLeastOneAuthorWithSlug(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findAuthorBySlugGateway)(FindAuthorBySlug\Request::fromData($response));

            if ($response->getAuthor()->getSlug()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getAuthor()->getSlug();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my author with:
     */
    public function iUpdateMyAuthorWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge(['identifier' => $this->responses[0]->getAuthor()->getId()->getValue()], $row);
            $this->responses[] = ($this->updateAuthorGateway)(UpdateAuthor\Request::fromData($data));
        }

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the author should be updated with:
     */
    public function theAuthorshouldBeUpdatedWith(TableNode $table)
    {
        foreach ($table as $row) {
            $response = ($this->findAuthorBySlugGateway)(FindAuthorBySlug\Request::fromData($row));

            Assert::true($response->data()['slug'] === $row['slug']);
            Assert::true($response->data()['name'] === $row['name']);
        }
    }

    /**
     * @When I delete this author
     */
    public function iDeleteThisAuthor()
    {
        $this->responses[] = ($this->deleteAuthorGateway)(DeleteAuthor\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the author should not be found
     */
    public function theAuthorshouldNotBeFound()
    {
        try {
            ($this->findAuthorBySlugGateway)(FindAuthorBySlug\Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
