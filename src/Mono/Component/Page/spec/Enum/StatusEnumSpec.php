<?php

namespace spec\Mono\Component\Page\Enum;

use Mono\Component\Page\Enum\StatusEnum;
use Mono\Component\Page\Exception\UnknownStatusException;
use PhpSpec\ObjectBehavior;

class StatusEnumSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(StatusEnum::class);
    }

    public function it_should_have_a_value()
    {
        $this->getValue(StatusEnum::DRAFT)->shouldBeString();
    }

    public function it_should_have_some_values()
    {
        $this->getValues()->shouldBeArray();
        $this->getValues()->shouldHaveCount(2);

        $this->getValues()[$this->getValue(StatusEnum::DRAFT)]->shouldBeString();
        $this->getValues()[$this->getValue(StatusEnum::DRAFT)]->shouldReturn(StatusEnum::DRAFT);
        $this->getValues()[$this->getValue(StatusEnum::PUBLISHED)]->shouldReturn(StatusEnum::PUBLISHED);
    }

    public function it_should_throw_an_exception_on_invalid_value()
    {
        $this->shouldThrow(UnknownStatusException::class)->during('getValue', [
            'foo',
        ]);
    }
}
