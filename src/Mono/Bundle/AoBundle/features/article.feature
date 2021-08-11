@cms
Feature:
    As a developer
    I want to manage my articles and tests my gateways

    Background: Prepare
        Given I have a space named "test" with a category named "test"

    Scenario: Create a article
        Given I want to create a article
            | name         | slug |
            | test article | test |
        When I create this article
        Then I should be able to find my article with his identifier
        And I should be able to find my article with his slug

    Scenario: List articles
        Given I already have a article with slug
            | slug |
            | test |
        When I list all articles
        Then I should have at least one article with slug:
            | slug |
            | test |

    Scenario: Update an existing article
        Given I already have a article with slug
            | slug |
            | test |
        When I update my article with:
            | name  | slug | content      |
            | test2 | test | test content |
        Then the article should be updated with
            | slug | name  |
            | test | test2 |

    Scenario: Remove an existing article
        Given I already have a article with slug
            | slug |
            | test |
        When I remove this article
        Then the article should not be found

    Scenario: Clean
        Given I already have a space with code
            | code |
            | TEST |
        When I remove this space
        Then the space should not be found
        And I already have a category with slug
            | slug |
            | test |
        When I remove this category
        Then the category should not be found
