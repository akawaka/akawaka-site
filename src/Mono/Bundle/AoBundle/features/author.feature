@author
Feature:
    As a developer
    I want to manage my authors and tests my gateways

    Background: Create an author
        Given I want to create an author
            | name        | slug |
            | test author | test |
        When I create this author
        Then I should be able to find my author with his identifier
        And I should be able to find my author with his slug "test"

    Scenario: List authors
        Given I already have an author with slug
            | slug |
            | test |
        When I list all authors
        Then I should have at least one author with slug
            | slug |
            | test |

    Scenario: Update an existing author
        Given I already have an author with slug
            | slug |
            | test |
        When I update my author with:
            | name  | slug |
            | test2 | test |
        Then the author should be updated with:
            | slug | name  |
            | test | test2 |

    Scenario: Remove an existing author
        Given I already have an author with slug
            | slug |
            | test |
        When I delete this author
        Then the author should not be found
