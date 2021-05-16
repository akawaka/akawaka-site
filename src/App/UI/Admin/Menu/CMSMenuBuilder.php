<?php

declare(strict_types=1);

namespace App\UI\Admin\Menu;

use App\UI\Admin\Controller\Routes;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Mono\Bundle\UIBundle\Infrastructure\Menu\Event\MenuBuilderEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class CMSMenuBuilder
{
    public const EVENT_NAME = 'mono.menu.admin.cms';

    public function __construct(
        private FactoryInterface $factory,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu
            ->addChild('home', ['route' => Routes::ADMIN_CMS_INDEX['name']])
            ->setLabel('admin.cms.ui.layout.sidebar.dashboard')
        ;

        $this->addContentMenu($menu);
        $this->addSettingsMenu($menu);

        $this->eventDispatcher->dispatch(
            new MenuBuilderEvent($this->factory, $menu),
            self::EVENT_NAME
        );

        return $menu;
    }

    private function addContentMenu(ItemInterface $menu): void
    {
        $content = $menu
            ->addChild('content')
            ->setLabel('admin.cms.ui.layout.sidebar.content')
        ;

        $content
            ->addChild('pages', ['route' => Routes::ADMIN_CMS_PAGES_INDEX['name']])
            ->setLabel('admin.cms.ui.layout.sidebar.pages')
        ;

        $content
            ->addChild('articles', ['route' => Routes::ADMIN_CMS_ARTICLES_INDEX['name']])
            ->setLabel('admin.cms.ui.layout.sidebar.articles')
        ;
    }

    private function addSettingsMenu(ItemInterface $menu): void
    {
        $content = $menu
            ->addChild('settings')
            ->setLabel('admin.cms.ui.layout.sidebar.configuration')
        ;

        $content
            ->addChild('pages', ['route' => Routes::ADMIN_CMS_CATEGORIES_INDEX['name']])
            ->setLabel('admin.cms.ui.layout.sidebar.categories')
        ;

        $content
            ->addChild('articles', ['route' => Routes::ADMIN_CMS_CHANNELS_INDEX['name']])
            ->setLabel('admin.cms.ui.layout.sidebar.channels')
        ;
    }
}
