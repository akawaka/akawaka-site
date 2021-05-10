<?php

namespace spec\Mono\Component\Page\Exception;

use Mono\Component\Page\Exception\PageNotFoundException;
use PhpSpec\ObjectBehavior;

class PageNotFoundExceptionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PageNotFoundException::class);
        $this->shouldBeAnInstanceOf(\Exception::class);
    }

    public function let()
    {
        $this->beConstructedWith('foobar');
        $this->getMessage()->shouldMatch('/foobar/');
    }
}
