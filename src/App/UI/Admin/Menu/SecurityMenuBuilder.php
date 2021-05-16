<?php

declare(strict_types=1);

namespace App\UI\Admin\Menu;

use App\UI\Admin\Controller\Routes;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Mono\Bundle\UIBundle\Infrastructure\Menu\Event\MenuBuilderEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class SecurityMenuBuilder
{
    public const EVENT_NAME = 'mono.menu.admin.security';

    public function __construct(
        private FactoryInterface $factory,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu
            ->addChild('home', ['route' => Routes::ADMIN_SECURITY_INDEX['name']])
            ->setLabel('admin.security.ui.layout.sidebar.dashboard')
            ->setLinkAttribute('class', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md')
        ;

        $this->addSecurityMenu($menu);

        $this->eventDispatcher->dispatch(
            new MenuBuilderEvent($this->factory, $menu),
            self::EVENT_NAME
        );

        return $menu;
    }

    private function addSecurityMenu(ItemInterface $menu): void
    {
        $content = $menu
            ->addChild('content')
            ->setLabel('admin.security.ui.layout.sidebar.content')
            ->setLinkAttribute('class', 'px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider')
        ;

        $content
            ->addChild('admins', ['route' => Routes::ADMIN_SECURITY_ADMINS_INDEX['name']])
            ->setLabel('admin.security.ui.layout.sidebar.admins')
            ->setLinkAttribute('class', 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md')
        ;
    }
}
