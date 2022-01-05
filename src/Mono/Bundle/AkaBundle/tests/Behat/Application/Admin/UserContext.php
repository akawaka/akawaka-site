<?php

declare(strict_types=1);

namespace Mono\Tests\Bundle\AkaBundle\Behat\Application\Admin;

use Behat\Gherkin\Node\TableNode;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\CreateUser;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUserById;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUsers;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\DeleteUser;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdateUser;
use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdatePassword;
use Behat\Behat\Context\Context;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Webmozart\Assert\Assert;

final class UserContext implements Context
{
    public function __construct(
        private CreateUser\Gateway $createUserGateway,
        private FindUserById\Gateway $findUserByIdGateway,
        private FindUsers\Gateway $findUsersGateway,
        private DeleteUser\Gateway $deleteUserGateway,
        private UpdateUser\Gateway $updateUserGateway,
        private UpdatePassword\Gateway $updatePasswordGateway,
        private array $requests = [],
        private array $responses = [],
    ) {
    }

    /**
     * @Given I want to create a user
     */
    public function iWantToCreateAUser(TableNode $table)
    {
        /** @var array $row */
        foreach ($table as $row) {
            $this->requests[] = CreateUser\Request::fromData($row);
        }
    }

    /**
     * @When I create this user
     */
    public function iCreateThisUser()
    {
        foreach ($this->requests as $request) {
            $this->responses[] = ($this->createUserGateway)($request);
        }

        Assert::allIsInstanceOf($this->responses, CreateUser\Response::class);
    }

    /**
     * @Then I should be able to find my user with his identifier
     */
    public function iShouldBeAbleToFindMyUserWithHisIdentifier()
    {
        foreach ($this->responses as $response) {
            $result = ($this->findUserByIdGateway)(FindUserById\Request::fromData($response->data()));
            Assert::isInstanceOf($result, FindUserById\Response::class);
        }
    }

    /**
     * @Given I already have a user with id
     */
    public function iAlreadyHaveAUserWithId()
    {
        $this->responses = ($this->findUsersGateway)(FindUsers\Request::fromData())->data();

        Assert::notEmpty($this->responses);
    }

    /**
     * @When I list all users
     */
    public function iListAllUsers()
    {
        $this->responses = ($this->findUsersGateway)(FindUsers\Request::fromData())->data();

        Assert::notEmpty($this->responses);
    }

    /**
     * @Then I should have at least one user with username
     */
    public function iShouldHaveAtLeastOneUserWithUsername(TableNode $table)
    {
        $result = [];

        foreach ($this->responses as $response) {
            $response = ($this->findUserByIdGateway)(FindUserById\Request::fromData($response));

            if ($response->getUser()->getUsername()->getValue() === $table->getColumn(0)[1]) {
                $result[] = $response->getUser()->getId();
            }
        }

        Assert::minCount($result, 1);
    }

    /**
     * @When I update my user with
     */
    public function iUpdateMyUserWith(TableNode $table)
    {
        $responses = [];

        foreach ($table as $row) {
            $data = array_merge(['identifier' => $this->responses[0]['identifier']], $row);
            $responses[] = ($this->updateUserGateway)(UpdateUser\Request::fromData($data));
        }

        Assert::minCount($responses, 1);
    }

    /**
     * @When I update my user password with
     */
    public function iUpdateMyUserPasswordWith(TableNode $table)
    {
        $responses = [];

        foreach ($table as $row) {
            $data = array_merge(['identifier' => $this->responses[0]['identifier']], $row);
            $responses[] = ($this->updatePasswordGateway)(UpdatePassword\Request::fromData($data));
        }

        Assert::minCount($responses, 1);
    }

    /**
     * @Then the user should be updated with
     */
    public function theUsershouldBeUpdatedWith(TableNode $table)
    {
        foreach ($table as $row) {
            $data = array_merge(['identifier' => $this->responses[0]['identifier']], $row);
            $response = ($this->findUserByIdGateway)(FindUserById\Request::fromData($data));

            Assert::true($response->data()['username'] === $row['username']);
            Assert::true($response->data()['email'] === $row['email']);
        }
    }

    /**
     * @When I delete this user
     */
    public function iDeleteThisUser()
    {
        $this->responses[] = ($this->deleteUserGateway)(DeleteUser\Request::fromData($this->responses[0]));

        Assert::minCount($this->responses, 1);
    }

    /**
     * @Then the user should not be found
     */
    public function theUsershouldNotBeFound()
    {
        try {
            ($this->findUserByIdGateway)(FindUserById\Request::fromData(
                $this->responses[0]
            ));
        } catch (\Exception $exception) {
            Assert::true(GatewayException::class === get_class($exception));
        }
    }
}
