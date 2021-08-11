@cms
Feature:
    As a developer
    I want to manage my spaces and tests my gateways

    Scenario: Create a space
        Given I want to create a space
            | name         | code |
            | test space | test |
        When I create this space
        Then I should be able to find my space with his identifier
        And I should be able to find my space with his code

    Scenario: List spaces
        Given I already have a space with code
            | code |
            | TEST |
        When I list all spaces
        Then I should have at least one space with code
            | code |
            | TEST |

    Scenario: Update an existing space
        Given I already have a space with code
            | code |
            | TEST |
        When I update my space with
            | name  | url                         | description               |
            | test2 | https://alexandre.balmes.co | Le super site d'alexandre |
        Then the space should be updated with
            | code | name  | url                         | description               |
            | TEST | test2 | https://alexandre.balmes.co | Le super site d'alexandre |

    Scenario: Publish an existing space
        Given I already have a space with code
            | code |
            | TEST |
        When I publish this space
        Then the space should be published

    Scenario: Close an existing space
        Given I already have a space with code
            | code |
            | TEST |
        When I close this space
        Then the space should be unpublished

    Scenario: Remove an existing space
        Given I already have a space with code
            | code |
            | TEST |
        When I remove this space
        Then the space should not be found
