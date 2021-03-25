<?php

declare(strict_types=1);

namespace spec\Black\Primitive\EmailAddress;

use Black\Primitive\EmailAddress\EmailAddress;
use Black\Primitive\EmailAddress\InvalidEmailAddressException;
use PhpSpec\ObjectBehavior;

class EmailAddressSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(EmailAddress::class);
    }

    public function let(): void
    {
        $this->beConstructedWith("recipient@domain.tld");
    }

    public function it_should_throw_an_exception(): void
    {
        $this
            ->shouldThrow(InvalidEmailAddressException::class)
            ->during('__construct', ['foo@bar']);
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_have_a_to_string(): void
    {
        $this->__toString()->shouldReturn("recipient@domain.tld");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function if_should_have_an_email(): void
    {
        $this->getValue()->shouldReturn("recipient@domain.tld");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_have_an_recipient(): void
    {
        $this->getRecipient()->shouldReturn("recipient");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_have_a_domain(): void
    {
        $this->getDomain()->shouldReturn("domain");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_have_a_tld(): void
    {
        $this->getTld()->shouldReturn("tld");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_return_an_email_as_array(): void
    {
        $this->getValueAsArray()->shouldBeArray();
        $this->getValueAsArray()['domain']->shouldReturn("domain");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_be_equal(): void
    {
        $email = new EmailAddress("recipient@domain.tld");
        $this->isEqualTo($email)->shouldReturn(true);
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_explode_a_tld_with_two_dots(): void
    {
        $this->beConstructedWith("recipient@domain.co.uk");
        $this->getTld()->shouldReturn("co.uk");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_accept_email_with_plus(): void
    {
        $this->beConstructedWith("recipient+test@domain.tld");
        $this->getValueAsArray()['recipient']->shouldReturn("recipient+test");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     *
     * This test will fail but it shouldn't because this mail is valid.
     */
    public function it_should_accept_email_with_wildcard(): void
    {
        $this->beConstructedWith("recipient@test.domain.com");
        $this->getValueAsArray()['domain']->shouldNotReturn("test.domain");
    }

    /**
     * @psalm-suppress UndefinedMagicMethod
     */
    public function it_should_not_works_with_unicode_because_of_validate_email(): void
    {
        $this
            ->shouldThrow(InvalidEmailAddressException::class)
            ->during('__construct', ['recipient@domain.中国']);
    }
}
