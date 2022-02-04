@page
Feature:
    As a developer
    I want to manage my pages and tests my gateways

    Background: Prepare
        Given I have a space named "default"
        And I want to create a page for this space
            | name      |
            | test page |
        When I create this page for my space
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
            | test2 slug | test-slug | Le super site d'alexandre |
        Then the page should be updated with
            | name       | slug       | content                   |
            | test2 slug | test-slug | Le super site d'alexandre |

    Scenario: Publish an existing page
        Given I already have a page with slug
            | slug      |
            | test-page |
        When I publish this page
        Then the page should be published

    Scenario: Unpublish an existing page
        Given I already have a page with slug
            | slug      |
            | test-page |
        When I unpublish this page
        Then the page should be unpublished

    Scenario: Remove an existing page
        Given I already have a page with slug
            | slug      |
            | test-page |
        When I delete this page
        Then the page should not be found
