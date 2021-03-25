<?php

namespace spec\Black\Component\Page\Entity;

use Black\Component\Page\Entity\Page;
use Black\Component\Page\Enum\StatusEnum;
use PhpSpec\ObjectBehavior;
use Safe\DateTimeImmutable;

class PageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Page::class);
    }

    function let()
    {
        $this->getStatus()->shouldReturn(StatusEnum::DRAFT);
        $this->getDateCreated()->shouldBeAnInstanceOf(\DateTimeInterface::class);
        $this->getDateUpdated()->shouldBeNull();
    }

    function it_should_be_published()
    {
        $this->publish();
        $this->getDateUpdated()->shouldHaveType(DateTimeImmutable::class);
        $this->getStatus()->shouldReturn(StatusEnum::PUBLISHED);
    }

    function it_should_be_unpublished()
    {
        $this->unpublish();
        $this->getDateUpdated()->shouldHaveType(DateTimeImmutable::class);
        $this->getStatus()->shouldReturn(StatusEnum::DRAFT);
    }
}
