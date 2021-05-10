<?php

namespace spec\Mono\Component\Page\Exception;

use Mono\Component\Page\Exception\UnknownStatusException;
use PhpSpec\ObjectBehavior;

class UnknownStatusExceptionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(UnknownStatusException::class);
        $this->shouldBeAnInstanceOf(\Exception::class);
    }

    public function let()
    {
        $this->beConstructedWith('foobar');
        $this->getMessage()->shouldMatch('/foobar/');
    }
}
