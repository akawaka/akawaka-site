<?php

namespace spec\Black\Component\Page\Exception;

use Black\Component\Page\Enum\StatusEnum;
use Black\Component\Page\Exception\UnknownStatusException;
use PhpSpec\ObjectBehavior;

class UnknownStatusExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnknownStatusException::class);
        $this->shouldBeAnInstanceOf(\Exception::class);
    }

    function let()
    {
        $this->beConstructedWith('foobar');
        $this->getMessage()->shouldMatch('/foobar/');
    }
}
