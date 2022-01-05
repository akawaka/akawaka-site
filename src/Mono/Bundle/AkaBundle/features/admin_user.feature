@admin_user
Feature:
    As a developer
    I want to manage my users and tests my gateways

    Background:
        Given I want to create a user
            | username | email         | password |
            | jdoe     | jdoe@jdoe.com | test     |
        When I create this user

    Scenario: Create an user
        Then I should be able to find my user with his identifier

    Scenario: List users
        Given I already have a user with id
        When I list all users
        Then I should have at least one user with username
            | username |
            | jdoe     |

    Scenario: Update an existing user
        Given I already have a user with id
        When I update my user with
            | username  | email          |
            | jdoe2     | jdoe2@jdoe.com |
        When I update my user password with
            | password  |
            | jdoe2     |
        Then the user should be updated with
            | username  | email          |
            | jdoe2     | jdoe2@jdoe.com |

    Scenario: Remove an existing user
        Given I already have a user with id
        When I delete this user
        Then the user should not be found
