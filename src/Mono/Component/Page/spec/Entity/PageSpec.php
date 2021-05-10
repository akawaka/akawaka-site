<?php

namespace spec\Mono\Component\Page\Entity;

use Mono\Component\Page\Entity\Page;
use Mono\Component\Page\Enum\StatusEnum;
use PhpSpec\ObjectBehavior;
use Safe\DateTimeImmutable;

class PageSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Page::class);
    }

    public function let()
    {
        $this->getStatus()->shouldReturn(StatusEnum::DRAFT);
        $this->getDateCreated()->shouldBeAnInstanceOf(\DateTimeInterface::class);
        $this->getDateUpdated()->shouldBeNull();
    }

    public function it_should_be_published()
    {
        $this->publish();
        $this->getDateUpdated()->shouldHaveType(DateTimeImmutable::class);
        $this->getStatus()->shouldReturn(StatusEnum::PUBLISHED);
    }

    public function it_should_be_unpublished()
    {
        $this->unpublish();
        $this->getDateUpdated()->shouldHaveType(DateTimeImmutable::class);
        $this->getStatus()->shouldReturn(StatusEnum::DRAFT);
    }
}
