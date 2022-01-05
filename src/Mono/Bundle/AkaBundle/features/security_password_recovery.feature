@security_password_recovery
Feature:
    As a developer
    I want to manage my users and tests my gateways

    Background:
        Given I have a user
            | username | email         | password |
            | jdoe     | jdoe@jdoe.com | test     |

    Scenario: User should exist and be able to recover his password
        Given I want to reset my password
        Then A recovery token is created
        And my new password should be generated
