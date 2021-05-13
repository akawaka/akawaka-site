@category @article
Feature:
    As a developer
    I want to manage my categories and tests my gateways

    Scenario: Create a category
        Given I want to create a category:
            | name          | slug |
            | test category | test |
        When I create this category
        Then I should be able to find my category with his identifier
        And I should be able to find my category with his slug

    Scenario: List categories
        Given I already have a category with slug:
            | slug |
            | test |
        When I list all categories
        Then I should have at least one category with slug:
            | slug |
            | test |

    Scenario: Update an existing category
        Given I already have a category with slug:
            | slug |
            | test |
        When I update my category with:
            | name  | slug |
            | test2 | test |
        Then the category should be updated with:
            | slug | name  |
            | test | test2 |

    Scenario: Remove an existing category
        Given I already have a category with slug:
            | slug |
            | test |
        When I remove this category
        Then the category should not be found
