<?php

namespace spec\Black\Component\Page\Enum;

use Black\Component\Page\Enum\StatusEnum;
use Black\Component\Page\Exception\UnknownStatusException;
use PhpSpec\ObjectBehavior;

class StatusEnumSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StatusEnum::class);
    }

    function it_should_have_a_value()
    {
        $this->getValue(StatusEnum::DRAFT)->shouldBeString();
    }

    function it_should_have_some_values()
    {
        $this->getValues()->shouldBeArray();
        $this->getValues()->shouldHaveCount(2);

        $this->getValues()[$this->getValue(StatusEnum::DRAFT)]->shouldBeString();
        $this->getValues()[$this->getValue(StatusEnum::DRAFT)]->shouldReturn(StatusEnum::DRAFT);
        $this->getValues()[$this->getValue(StatusEnum::PUBLISHED)]->shouldReturn(StatusEnum::PUBLISHED);

    }

    function it_should_throw_an_exception_on_invalid_value()
    {
        $this->shouldThrow(UnknownStatusException::class)->during('getValue', [
            'foo'
        ]);
    }
}
