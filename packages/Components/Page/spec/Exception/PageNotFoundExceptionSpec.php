<?php

namespace spec\Black\Component\Page\Exception;

use Black\Component\Page\Enum\StatusEnum;
use Black\Component\Page\Exception\PageNotFoundException;
use PhpSpec\ObjectBehavior;

class PageNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PageNotFoundException::class);
        $this->shouldBeAnInstanceOf(\Exception::class);
    }

    function let()
    {
        $this->beConstructedWith('foobar');
        $this->getMessage()->shouldMatch('/foobar/');
    }
}
