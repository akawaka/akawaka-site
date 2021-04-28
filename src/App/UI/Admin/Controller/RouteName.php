<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller;

final class RouteName
{
    /**
     * Index
     */
    public const ADMIN_LOGIN = ['path' => '/admin/login', 'name' => 'admin_login'];

    public const ADMIN_INDEX = ['path' => '/admin/index', 'name' => 'admin_index'];

    public const ADMIN_CMS_INDEX = ['path' => '/admin/cms/index', 'name' => 'admin_cms_index'];

    public const ADMIN_SECURITY_INDEX = ['path' => '/admin/security/index', 'name' => 'admin_security_index'];

    /**
     * Pages
     */
    public const ADMIN_CMS_PAGES_CREATE = ['path' => '/admin/cms/pages/create', 'name' => 'admin_cms_pages_create'];

    public const ADMIN_CMS_PAGES_DELETE = ['path' => '/admin/cms/pages/{identifier}/delete', 'name' => 'admin_cms_pages_delete'];

    public const ADMIN_CMS_PAGES_LIST = ['path' => '/admin/cms/pages', 'name' => 'admin_cms_pages_index'];

    public const ADMIN_CMS_PAGES_PUBLISH = ['path' => '/admin/cms/pages/{identifier}/publish', 'name' => 'admin_cms_pages_publish'];

    public const ADMIN_CMS_PAGES_UNPUBLISH = ['path' => '/admin/cms/pages/{identifier}/unpublish', 'name' => 'admin_cms_pages_unpublish'];

    public const ADMIN_CMS_PAGES_UPDATE = ['path' => '/admin/cms/pages/{identifier}/update', 'name' => 'admin_cms_pages_update'];

    /**
     * Articles
     */
    public const ADMIN_CMS_ARTICLES_CREATE = ['path' => '/admin/cms/articles/create', 'name' => 'admin_cms_articles_create'];

    public const ADMIN_CMS_ARTICLES_DELETE = ['path' => '/admin/cms/articles/{identifier}/delete', 'name' => 'admin_cms_articles_delete'];

    public const ADMIN_CMS_ARTICLES_LIST = ['path' => '/admin/cms/articles', 'name' => 'admin_cms_articles_index'];

    public const ADMIN_CMS_ARTICLES_PUBLISH = ['path' => '/admin/cms/articles/{identifier}/publish', 'name' => 'admin_cms_articles_publish'];

    public const ADMIN_CMS_ARTICLES_UNPUBLISH = ['path' => '/admin/cms/articles/{identifier}/unpublish', 'name' => 'admin_cms_articles_unpublish'];

    public const ADMIN_CMS_ARTICLES_UPDATE = ['path' => '/admin/cms/articles/{identifier}/update', 'name' => 'admin_cms_articles_update'];

    /**
     * Categories
     */
    public const ADMIN_CMS_CATEGORIES_CREATE = ['path' => '/admin/cms/categories/create', 'name' => 'admin_cms_categories_create'];

    public const ADMIN_CMS_CATEGORIES_DELETE = ['path' => '/admin/cms/categories/{identifier}/delete', 'name' => 'admin_cms_categories_delete'];

    public const ADMIN_CMS_CATEGORIES_LIST = ['path' => '/admin/cms/categories', 'name' => 'admin_cms_categories_index'];

    public const ADMIN_CMS_CATEGORIES_UPDATE = ['path' => '/admin/cms/categories/{identifier}/update', 'name' => 'admin_cms_categories_update'];

    /**
     * Channels
     */
    public const ADMIN_CMS_CHANNELS_CREATE = ['path' => '/admin/cms/channels/create', 'name' => 'admin_cms_channels_create'];

    public const ADMIN_CMS_CHANNELS_DELETE = ['path' => '/admin/cms/channels/{identifier}/delete', 'name' => 'admin_cms_channels_delete'];

    public const ADMIN_CMS_CHANNELS_LIST = ['path' => '/admin/cms/channels', 'name' => 'admin_cms_channels_index'];

    public const ADMIN_CMS_CHANNELS_UPDATE = ['path' => '/admin/cms/channels/{identifier}/update', 'name' => 'admin_cms_channels_update'];

    /**
     * Admins
     */
    public const ADMIN_SECURITY_ADMINS_CREATE = ['path' => '/admin/security/admins/create', 'name' => 'admin_security_admins_create'];

    public const ADMIN_SECURITY_ADMINS_DELETE = ['path' => '/admin/security/admins/{identifier}/delete', 'name' => 'admin_security_admins_delete'];

    public const ADMIN_SECURITY_ADMINS_LIST = ['path' => '/admin/security/admins', 'name' => 'admin_security_admins_index'];

    public const ADMIN_SECURITY_ADMINS_UPDATE = ['path' => '/admin/security/admins/{identifier}/update', 'name' => 'admin_security_admins_update'];
}
