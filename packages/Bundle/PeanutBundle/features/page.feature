Feature:
  In order to have content on my site
  I want to manage pages

  Scenario: Create a page
    Given I create a page
    Then I should be able to find all my pages

  Scenario: Create a page with slug
    Given I create a page with slug
    Then I should be able to find my page with slug
    Then I should be able to publish my page
    Then I should be able to unpublish my page
    Then I should be able to update my page
