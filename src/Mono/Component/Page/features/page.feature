@page
Feature:
    As a developer
    I want to manage my pages and tests my gateways

    Scenario: Create a page
        Given I want to create a page
            | name      |
            | test page |
        When I create this page
        Then I should be able to find my page with his identifier
        And I should be able to find my page with his slug "test-page"

    Scenario: List pages
        Given I already have a page with slug
            | slug      |
            | test-page |
        When I list all pages
        Then I should have at least one page with slug
            | slug      |
            | test-page |

    Scenario: Update an existing page
        Given I already have a page with slug
            | slug      |
            | test-page |
        When I update my page with
            | name       | slug       | content                   |
            | test2 slug | test2-slug | Le super site d'alexandre |
        Then the page should be updated with
            | name       | slug       | content                   |
            | test2 slug | test2-slug | Le super site d'alexandre |

    Scenario: Remove an existing page
        Given I already have a page with slug
            | slug       |
            | test2-slug |
        When I remove this page
        Then the page should not be found
