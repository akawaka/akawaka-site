<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Tests\Behat;

use Behat\Behat\Context\Context;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\CreatePage\CreatePageGateway;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\CreatePage\CreatePageRequest;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\CreatePage\CreatePageResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageById\FindPageByIdGateway;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageById\FindPageByIdRequest;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageById\FindPageByIdResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageBySlug\FindPageBySlugGateway;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageBySlug\FindPageBySlugRequest;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPageBySlug\FindPageBySlugResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPages\FindPagesGateway;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPages\FindPagesRequest;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPages\FindPagesResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus\FindPagesByStatusGateway;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus\FindPagesByStatusRequest;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPagesByStatus\FindPagesByStatusResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\PublishPage\PublishPageGateway;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\PublishPage\PublishPageRequest;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\PublishPage\PublishPageResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\UnpublishPage\UnpublishPageGateway;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\UnpublishPage\UnpublishPageRequest;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\UnpublishPage\UnpublishPageResponse;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\UpdatePage\UpdatePageGateway;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\UpdatePage\UpdatePageRequest;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\UpdatePage\UpdatePageResponse;
use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;
use Black\Bundle\PeanutBundle\Infrastructure\Slugger\SluggerInterface;
use Faker\Factory;
use Webmozart\Assert\Assert;

final class PageContext implements Context
{
    private CreatePageGateway $createPageGateway;

    private FindPageByIdGateway $findPageByIdGateway;

    private FindPageBySlugGateway $findPageBySlugGateway;

    private FindPagesGateway $findPagesGateway;

    private FindPagesByStatusGateway $findPagesByStatusGateway;

    private PublishPageGateway $publishPageGateway;

    private UnpublishPageGateway $unpublishPageGateway;

    private UpdatePageGateway $updatePageGateway;

    private SluggerInterface $slugger;

    private $slug;

    private $page;

    public function __construct(
        CreatePageGateway $createPageGateway,
        FindPageByIdGateway $findPageByIdGateway,
        FindPageBySlugGateway $findPageBySlugGateway,
        FindPagesGateway $findPagesGateway,
        FindPagesByStatusGateway $findPagesByStatusGateway,
        PublishPageGateway $publishPageGateway,
        UnpublishPageGateway $unpublishPageGateway,
        UpdatePageGateway $updatePageGateway,
        SluggerInterface $slugger
    ) {
        $this->createPageGateway = $createPageGateway;
        $this->findPageByIdGateway = $findPageByIdGateway;
        $this->findPageBySlugGateway = $findPageBySlugGateway;
        $this->findPagesGateway = $findPagesGateway;
        $this->findPagesByStatusGateway = $findPagesByStatusGateway;
        $this->publishPageGateway = $publishPageGateway;
        $this->unpublishPageGateway = $unpublishPageGateway;
        $this->updatePageGateway = $updatePageGateway;
        $this->slugger = $slugger;

        $this->slug = null;
        $this->page = null;
    }

    /**
     * @Given I create a page
     */
    public function iCreateAPage(): void
    {
        $faker = Factory::create();

        $request = CreatePageRequest::fromData([
            'name' => $faker->words(5, true),
            'content' => $faker->sentences(3, true),
        ]);

        $response = ($this->createPageGateway)($request);

        Assert::isInstanceOf($response, CreatePageResponse::class);
        Assert::notEmpty($response->data());
        Assert::keyExists($response->data(), 'id');
    }

    /**
     * @Given I create a page with slug
     */
    public function iCreateAPageWithSlug(): void
    {
        $faker = Factory::create();
        $this->slug = $faker->slug;
        $name = $faker->words(5, true);

        $request = CreatePageRequest::fromData([
            'name' => $name,
            'slug' => $this->slug,
            'content' => $faker->sentences(3, true),
        ]);

        $response = ($this->createPageGateway)($request);

        Assert::isInstanceOf($response, CreatePageResponse::class);
        Assert::notEmpty($response->data());
        Assert::keyExists($response->data(), 'id');
        Assert::notEq($this->slugger->slugify($name), $this->slug);
    }

    /**
     * @Then I should be able to find all my pages
     */
    public function iShouldBeAbleToFindMyPages(): void
    {
        $request = FindPagesRequest::fromData();
        $response = ($this->findPagesGateway)($request);

        Assert::isInstanceOf($response, FindPagesResponse::class);
        Assert::notEmpty($response->data());
    }

    /**
     * @Then I should be able to find all my pages by status
     */
    public function iShouldBeAbleToFindMyPagesByStatus(): void
    {
        $request = FindPagesByStatusRequest::fromData();
        $response = ($this->findPagesByStatusGateway)($request);

        Assert::isInstanceOf($response, FindPagesByStatusResponse::class);
        Assert::notEmpty($response->data());

        $this->page = $response->getPages()->first();
    }

    /**
     * @Then I should be able to find my page with slug
     */
    public function iShouldFindMyPageWithSlug()
    {
        $request = FindPageBySlugRequest::fromData([
            'slug' => $this->slug,
        ]);

        /* @var FindPageBySlugResponse page */
        $this->page = $response = ($this->findPageBySlugGateway)($request);

        Assert::isInstanceOf($response, FindPageBySlugResponse::class);
        Assert::notEmpty($response->data());

        Assert::isInstanceOf($response->getId(), PageId::class);
        Assert::string($response->data()['id']);
    }

    /**
     * @Then I should be able to find my page with id
     */
    public function iShouldFindMyPageWithId()
    {
        $request = FindPageByIdRequest::fromData([
            'id' => $this->page->getId()->getValue(),
        ]);

        $this->page = $response = ($this->findPageByIdGateway)($request);

        Assert::isInstanceOf($response, FindPageByIdResponse::class);
        Assert::notEmpty($response->data());
    }

    /**
     * @Then I should be able to publish my page
     */
    public function iShouldBeAbleToPublishMyPage()
    {
        $request = PublishPageRequest::fromData([
            'id' => $this->page->getId()->getValue(),
        ]);

        $response = ($this->publishPageGateway)($request);

        Assert::isInstanceOf($response, PublishPageResponse::class);
        Assert::notEmpty($response->data());
    }

    /**
     * @Then I should be able to unpublish my page
     */
    public function iShouldBeAbleToUnpublishMyPage()
    {
        $request = UnpublishPageRequest::fromData([
            'id' => $this->page->getId()->getValue(),
        ]);

        $response = ($this->unpublishPageGateway)($request);

        Assert::isInstanceOf($response, UnpublishPageResponse::class);
        Assert::notEmpty($response->data());
    }

    /**
     * @Then I should be able to update my page
     */
    public function iShouldBeAbleToUpdateMyPage()
    {
        $faker = Factory::create();

        $request = UpdatePageRequest::fromData([
            'id' => $this->page->getId()->getValue(),
            'name' => $faker->words(5, true),
            'slug' => $faker->slug,
            'content' => $this->page->getContent(),
        ]);

        $response = ($this->updatePageGateway)($request);

        Assert::isInstanceOf($response, UpdatePageResponse::class);
        Assert::notEmpty($response->data());
    }
}
