@cms @channel
Feature:
    As a developer
    I want to manage my channels and tests my gateways

    Scenario: Create a channel
        Given I want to create a channel:
            | name         | code |
            | test channel | test |
        When I create this channel
        Then I should be able to find my channel with his identifier
        And I should be able to find my channel with his code

    Scenario: List channels
        Given I already have a channel with code:
            | code |
            | TEST |
        When I list all channels
        Then I should have at least one channel with code:
            | code |
            | TEST |

    Scenario: Update an existing channel
        Given I already have a channel with code:
            | code |
            | TEST |
        When I update my channel with:
            | name  | url                         | description               |
            | test2 | https://alexandre.balmes.co | Le super site d'alexandre |
        Then the channel should be updated with:
            | code | name  | url                         | description               |
            | TEST | test2 | https://alexandre.balmes.co | Le super site d'alexandre |

    Scenario: Publish an existing channel
        Given I already have a channel with code:
            | code |
            | TEST |
        When I publish this channel
        Then the channel should be published

    Scenario: Close an existing channel
        Given I already have a channel with code:
            | code |
            | TEST |
        When I close this channel
        Then the channel should be unpublished

    Scenario: Remove an existing channel
        Given I already have a channel with code:
            | code |
            | TEST |
        When I remove this channel
        Then the channel should not be found
