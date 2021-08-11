<?php

declare(strict_types=1);

namespace App\Tests\Behat\CMS\Application;

use Mono\Bundle\AoBundle\Domain\Page\Common\Enum\StatusEnum;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model\SpaceInterface;
use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AoBundle\Application\Space\Gateway\FindSpaceByCode;
use Mono\Bundle\AoBundle\Application\Space\Gateway\CreateSpace;
use Mono\Component\Core\Application\Gateway\GatewayException;
use Mono\Bundle\AoBundle\Application\Page\Gateway\UnpublishPage;
use Mono\Bundle\AoBundle\Application\Page\Gateway\FindPageById;
use Mono\Bundle\AoBundle\Application\Page\Gateway\FindPageBySlug;
use Mono\Bundle\AoBundle\Application\Page\Gateway\FindPages;
use Mono\Bundle\AoBundle\Application\Page\Gateway\PublishPage;
use Mono\Bundle\AoBundle\Application\Page\Gateway\UpdatePage;
use Mono\Bundle\AoBundle\Application\Page\Gateway\CreatePage;
use Behat\Behat\Context\Context;
use Mono\Component\Page\Application\Gateway\CreatePage\Response;
use Mono\Component\Page\Application\Gateway\DeletePage;
use Mono\Component\Page\Application\Gateway\FindPageById\Request;
use Webmozart\Assert\Assert;

final class PageContext implements Context
{
    private ?SpaceInterface $space;

    private array $requests = [];

    private array $responses = [];

    private FindSpaceByCode\Gateway $findSpaceByCodeGateway;

    private CreateSpace\Gateway $createSpaceGateway;

    private UnpublishPage\Gateway $unpublishPageGateway;

    private CreatePage\Gateway $createPageGateway;

    private FindPageById\Gateway $findPageByIdGateway;

    private FindPageBySlug\Gateway $findPageBySlugGateway;

    private FindPages\Gateway $findPagesGateway;

    private PublishPage\Gateway $publishPageGateway;

    private DeletePage\Gateway $deletePageGateway;

    private UpdatePage\Gateway $updatePageGateway;

    public function __construct(
        UnpublishPage\Gateway $unpublishPageGateway,
        FindSpaceByCode\Gateway $findSpaceByCodeGateway,
        CreateSpace\Gateway $createSpaceGateway,
        CreatePage\Gateway $createPageGateway,
        FindPageById\Gateway $findPageByIdGateway,
        FindPageBySlug\Gateway $findPageBySlugGateway,
        FindPages\Gateway $findPagesGateway,
        PublishPage\Gateway $publishPageGateway,
        DeletePage\Gateway $deletePageGateway,
        UpdatePage\Gateway $updatePageGateway,
    ) {
        $this->createSpaceGateway = $createSpaceGateway;
        $this->findSpaceByCodeGateway = $findSpaceByCodeGateway;
        $this->createPageGateway = $createPageGateway;
        $this->unpublishPageGateway = $unpublishPageGateway;
        $this->findPageByIdGateway = $findPageByIdGateway;
        $this->findPageBySlugGateway = $findPageBySlugGateway;
        $this->findPagesGateway = $findPagesGateway;
        $this->publishPageGateway = $publishPageGateway;
        $this->deletePageGateway = $deletePageGateway;
        $this->updatePageGateway = $updatePageGateway;

        $this->space = null;
    }

    /**
     * @Given I have a space named :space
     */
    public function iHaveASpaceNamed(string $space)
    {
        try {
            $space = ($this->findSpaceByCodeGateway)(FindSpaceByCode\Request::fromData([
                'code' => $space,
            ]));
        } catch (GatewayException $exception) {
            $space = ($this->createSpaceGateway)(CreateSpace\Request::fromData([
                'code' => 'default',
                'name' => 'default',
            ]));
        }

        $this->space = $space->getSpace();
    }

    /**
     * @Given I want to create a page for this space
     */
    public function iWantToCreateAPageForMySpace(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreatePage\Request::fromData(array_merge([
                'spaces' => [$this->space->getId()->getValue()],
            ], $row));
        }
    }

    /**
     * @When I create this page for my space
     */
    public function iCreateThisPageForMySpace()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createPageGateway)($request);
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
     * @Then I should be able to find my page with his slug
     */
    public function iShouldBeAbleToFindMyPageWithHisSlug()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findPageBySlugGateway)(\Mono\Component\Page\Application\Gateway\FindPageBySlug\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindPageBySlug\Response::class);
        }
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
            $this->responses[] = ($this->findPageBySlugGateway)(\Mono\Component\Page\Application\Gateway\FindPageBySlug\Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, FindPageBySlug\Response::class);
    }

    /**
     * @When I list all pages
     */
    public function iListAllPages()
    {
        $this->responses = ($this->findPagesGateway)(\Mono\Component\Page\Application\Gateway\FindPages\Request::fromData())->data();
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
                'spaces' => $this->responses[0]->getPage()->getSpaces()->map(function (SpaceInterface $space) {
                    return $space->getId()->getValue();
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
        /** @var UpdatePage\Response $response */
        $response = $this->responses[0];

        foreach ($table as $row) {
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
        $Page = ($this->findPageBySlugGateway)(\Mono\Component\Page\Application\Gateway\FindPageBySlug\Request::fromData(
            $this->responses[0]->data()
        ));

        Assert::true(StatusEnum::PUBLISHED === $Page->data()['status']);
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
        $Page = ($this->findPageBySlugGateway)(\Mono\Component\Page\Application\Gateway\FindPageBySlug\Request::fromData(
            $this->responses[0]->data()
        ));

        Assert::true(StatusEnum::DRAFT === $Page->data()['status']);
    }

    /**
     * @When I delete this page
     */
    public function iDeleteThisPage()
    {
        $this->responses[] = ($this->deletePageGateway)(DeletePage\Request::fromData($this->responses[0]->data()));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the page should not be found
     */
    public function thePageShouldNotBeFound()
    {
        try {
            ($this->findPageBySlugGateway)(\Mono\Component\Page\Application\Gateway\FindPageBySlug\Request::fromData(
                $this->responses[0]->data()
            ));
        } catch (\Exception $exception) {
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
