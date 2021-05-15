<?php

declare(strict_types=1);

namespace App\UI\Admin\Menu;

use App\UI\Admin\Controller\Routes;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Mono\Bundle\AoBundle\Infrastructure\Menu\Event\MenuBuilderEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class MainMenuBuilder
{
    public const EVENT_NAME = 'mono.menu.admin.main';

    public function __construct(
        private FactoryInterface $factory,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu
            ->addChild('cms', ['route' => Routes::ADMIN_CMS_INDEX['name']])
            ->setLabel('admin.cms.ui.layout.header.title')
        ;

        $menu
            ->addChild('security', ['route' => Routes::ADMIN_SECURITY_INDEX['name']])
            ->setLabel('admin.security.ui.layout.header.title')
        ;

        $this->eventDispatcher->dispatch(
            new MenuBuilderEvent($this->factory, $menu),
            self::EVENT_NAME
        );

        return $menu;
    }
}
