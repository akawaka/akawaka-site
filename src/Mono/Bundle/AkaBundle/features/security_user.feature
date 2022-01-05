@security_user
Feature:
    As a developer
    I want to connect user on my application

    Background:
        Given I have a user
            | username | email         | password |
            | jdoe     | jdoe@jdoe.com | test     |

    Scenario: User should exist and be able to connect to application
        Given I should be able to find my user with his email
        And I should be able to find my user with his username
        Then I connect my user
