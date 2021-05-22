<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller;

final class Routes
{
    /**
     * Index.
     */
    public const ADMIN_LOGIN = ['path' => '/admin/login', 'name' => 'admin_login'];

    public const ADMIN_INDEX = ['path' => '/admin', 'name' => 'admin_index'];

    public const ADMIN_CMS_INDEX = ['path' => '/admin/cms/index', 'name' => 'admin_cms_index'];

    public const ADMIN_SECURITY_INDEX = ['path' => '/admin/security/index', 'name' => 'admin_security_index'];

    /**
     * Pages.
     */
    public const ADMIN_CMS_PAGES_CREATE = ['path' => '/admin/cms/pages/create', 'name' => 'admin_cms_pages_create'];

    public const ADMIN_CMS_PAGES_DELETE = ['path' => '/admin/cms/pages/{identifier}/delete', 'name' => 'admin_cms_pages_delete'];

    public const ADMIN_CMS_PAGES_INDEX = ['path' => '/admin/cms/pages', 'name' => 'admin_cms_pages_index'];

    public const ADMIN_CMS_PAGES_PUBLISH = ['path' => '/admin/cms/pages/{identifier}/publish', 'name' => 'admin_cms_pages_publish'];

    public const ADMIN_CMS_PAGES_UNPUBLISH = ['path' => '/admin/cms/pages/{identifier}/unpublish', 'name' => 'admin_cms_pages_unpublish'];

    public const ADMIN_CMS_PAGES_UPDATE = ['path' => '/admin/cms/pages/{identifier}/update', 'name' => 'admin_cms_pages_update'];

    /**
     * Articles.
     */
    public const ADMIN_CMS_ARTICLES_CREATE = ['path' => '/admin/cms/articles/create', 'name' => 'admin_cms_articles_create'];

    public const ADMIN_CMS_ARTICLES_DELETE = ['path' => '/admin/cms/articles/{identifier}/delete', 'name' => 'admin_cms_articles_delete'];

    public const ADMIN_CMS_ARTICLES_INDEX = ['path' => '/admin/cms/articles', 'name' => 'admin_cms_articles_index'];

    public const ADMIN_CMS_ARTICLES_PUBLISH = ['path' => '/admin/cms/articles/{identifier}/publish', 'name' => 'admin_cms_articles_publish'];

    public const ADMIN_CMS_ARTICLES_UNPUBLISH = ['path' => '/admin/cms/articles/{identifier}/unpublish', 'name' => 'admin_cms_articles_unpublish'];

    public const ADMIN_CMS_ARTICLES_UPDATE = ['path' => '/admin/cms/articles/{identifier}/update', 'name' => 'admin_cms_articles_update'];

    /**
     * Categories.
     */
    public const ADMIN_CMS_CATEGORIES_CREATE = ['path' => '/admin/cms/categories/create', 'name' => 'admin_cms_categories_create'];

    public const ADMIN_CMS_CATEGORIES_DELETE = ['path' => '/admin/cms/categories/{identifier}/delete', 'name' => 'admin_cms_categories_delete'];

    public const ADMIN_CMS_CATEGORIES_INDEX = ['path' => '/admin/cms/categories', 'name' => 'admin_cms_categories_index'];

    public const ADMIN_CMS_CATEGORIES_UPDATE = ['path' => '/admin/cms/categories/{identifier}/update', 'name' => 'admin_cms_categories_update'];

    /**
     * Spaces.
     */
    public const ADMIN_CMS_SPACES_CREATE = ['path' => '/admin/cms/spaces/create', 'name' => 'admin_cms_spaces_create'];

    public const ADMIN_CMS_SPACES_DELETE = ['path' => '/admin/cms/spaces/{identifier}/delete', 'name' => 'admin_cms_spaces_delete'];

    public const ADMIN_CMS_SPACES_INDEX = ['path' => '/admin/cms/spaces', 'name' => 'admin_cms_spaces_index'];

    public const ADMIN_CMS_SPACES_UPDATE = ['path' => '/admin/cms/spaces/{identifier}/update', 'name' => 'admin_cms_spaces_update'];

    /**
     * Admins.
     */
    public const ADMIN_SECURITY_PASSWORD_RESET = ['path' => '/admin/reset-password', 'name' => 'admin_password_reset'];

    public const ADMIN_SECURITY_PASSWORD_RESET_SUCCESS = ['path' => '/admin/reset-password/success', 'name' => 'admin_password_reset_success'];

    public const ADMIN_SECURITY_PASSWORD_RECOVER = ['path' => '/admin/recover-password/{token}', 'name' => 'admin_password_recover'];

    public const ADMIN_SECURITY_ADMINS_CREATE = ['path' => '/admin/security/admins/create', 'name' => 'admin_security_admins_create'];

    public const ADMIN_SECURITY_ADMINS_DELETE = ['path' => '/admin/security/admins/{identifier}/delete', 'name' => 'admin_security_admins_delete'];

    public const ADMIN_SECURITY_ADMINS_INDEX = ['path' => '/admin/security/admins', 'name' => 'admin_security_admins_index'];

    public const ADMIN_SECURITY_ADMINS_UPDATE = ['path' => '/admin/security/admins/{identifier}/update', 'name' => 'admin_security_admins_update'];
}
