<?php

declare(strict_types=1);

namespace Mono\Tests\Bundle\AkaBundle\Behat\Application\Security;

use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\CreateUser;
use Mono\Bundle\AkaBundle\Security\User\Application\Gateway\FindUserByUsernameOrEmail;
use Mono\Bundle\AkaBundle\Security\User\Application\Gateway\Connect;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

final class UserContext implements Context
{
    public function __construct(
        private CreateUser\Gateway $createUserGateway,
        private FindUserByUsernameOrEmail\Gateway $findUserByUsernameOrEmailGateway,
        private Connect\Gateway $connectGateway,
        private array $requests = [],
        private array $responses = [],
    ) {
    }

    /**
     * @Given I have a user
     */
    public function iWantToCreateAUser(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->responses[] = ($this->createUserGateway)(CreateUser\Request::fromData($row));
        }

        Assert::allIsInstanceOf($this->responses, CreateUser\Response::class);
    }

    /**
     * @Given I should be able to find my user with his email
     */
    public function iShouldBeAbleToFindMyUserWithHisEmail()
    {
        foreach ($this->requests as $request) {
            $result = ($this->findUserByUsernameOrEmailGateway)(FindUserByUsernameOrEmail\Request::fromData([
                'usernameOrEmail' => $request->data()['email'],
            ]));
            Assert::isInstanceOf($result, FindUserByUsernameOrEmail\Response::class);
        }
    }

    /**
     * @Given I should be able to find my user with his username
     */
    public function iShouldBeAbleToFindMyUserWithHisUsername()
    {
        foreach ($this->requests as $request) {
            $result = ($this->findUserByUsernameOrEmailGateway)(FindUserByUsernameOrEmail\Request::fromData([
                'usernameOrEmail' => $request->data()['username'],
            ]));
            Assert::isInstanceOf($result, FindUserByUsernameOrEmail\Response::class);
        }
    }

    /**
     * @Given I connect my user
     */
    public function iConnectAUser()
    {
        foreach ($this->requests as $request) {
            $result = ($this->connectGateway)(Connect\Request::fromData($request->data()));
            Assert::isInstanceOf($result, Connect\Response::class);
        }
    }
}
