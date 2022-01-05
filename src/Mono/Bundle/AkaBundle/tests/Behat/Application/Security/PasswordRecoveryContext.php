<?php

declare(strict_types=1);

namespace Mono\Tests\Bundle\AkaBundle\Behat\Application\Security;

use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\CreateUser;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\CreatePasswordRecovery;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\FindPasswordRecoveryById;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\GeneratePassword;
use Mono\Bundle\AkaBundle\Security\User\Application\Gateway\Connect;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

final class PasswordRecoveryContext implements Context
{
    public function __construct(
        private CreateUser\Gateway $createUserGateway,
        private CreatePasswordRecovery\Gateway $createPasswordRecoveryGateway,
        private FindPasswordRecoveryById\Gateway $findPasswordRecoveryGateway,
        private GeneratePassword\Gateway $generatePasswordGateway,
        private array $requests = [],
        private array $responses = [],
    ) {
    }

    /**
     * @Given I have a user
     */
    public function iHaveAUser(TableNode $table)
    {
        $responses = [];

        /** @var array $row */
        foreach ($table as $row) {
            $responses[] = ($this->createUserGateway)(CreateUser\Request::fromData($row));
        }

        Assert::allIsInstanceOf($responses, CreateUser\Response::class);
    }

    /**
     * @Given I want to reset my password
     */
    public function iWantToResetMyPassword()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createPasswordRecoveryGateway)(CreatePasswordRecovery\Request::fromData([
                'usernameOrEmail' => $request->data()['email'],
            ]));
        }

        Assert::allIsInstanceOf($this->responses,  CreatePasswordRecovery\Response::class);
    }

    /**
     * @Given A recovery token is created
     */
    public function aRecoveryTokenIsCreated()
    {

    }

    /**
     * @Given my new password should be generated
     */
    public function myNewPasswordShouldBeGenerated()
    {

    }
}
