<?php

declare(strict_types=1);

namespace App\UI\Admin\EventHandler;

use App\CMS\Application\Operation\Write\CreateArticle\ArticleWasCreated;
use App\CMS\Application\Operation\Write\CreateCategory\CategoryWasCreated;
use App\CMS\Application\Operation\Write\CreateChannel\ChannelWasCreated;
use App\CMS\Application\Operation\Write\CreatePage\PageWasCreated;
use Mono\Component\AdminSecurity\Application\Operation\Write\Authenticate\AdminWasAuthenticated;
use Mono\Component\AdminSecurity\Application\Operation\Write\Remove\AdminWasRemoved;
use Mono\Component\AdminSecurity\Application\Operation\Write\Update\AdminWasUpdated;
use Mono\Component\AdminSecurity\Application\Operation\Write\UpdatePassword\AdminPasswordWasUpdated;
use Mono\Component\Article\Application\Operation\Write\PublishArticle\ArticleWasPublished;
use Mono\Component\Article\Application\Operation\Write\RemoveArticle\ArticleWasRemoved;
use Mono\Component\Article\Application\Operation\Write\RemoveCategory\CategoryWasRemoved;
use Mono\Component\Article\Application\Operation\Write\UnpublishArticle\ArticleWasUnpublished;
use Mono\Component\Article\Application\Operation\Write\UpdateArticle\ArticleWasUpdated;
use Mono\Component\Article\Application\Operation\Write\UpdateCategory\CategoryWasUpdated;
use Mono\Component\Channel\Application\Operation\Write\Close\ChannelWasClosed;
use Mono\Component\Channel\Application\Operation\Write\Publish\ChannelWasPublished;
use Mono\Component\Channel\Application\Operation\Write\Remove\ChannelWasRemoved;
use Mono\Component\Channel\Application\Operation\Write\Update\ChannelWasUpdated;
use Mono\Component\Core\Infrastructure\Notifier\BrowserNotificationInterface;
use Mono\Component\Core\Infrastructure\Notifier\NotificationContext;
use Mono\Component\Page\Application\Operation\Write\Publish\PageWasPublished;
use Mono\Component\Page\Application\Operation\Write\Remove\PageWasRemoved;
use Mono\Component\Page\Application\Operation\Write\Unpublish\PageWasUnpublished;
use Mono\Component\Page\Application\Operation\Write\Update\PageWasUpdated;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\NoRecipient;
use Symfony\Contracts\Translation\TranslatorInterface;

final class FlashNotifier implements MessageSubscriberInterface
{
    private NotifierInterface $notifier;

    private TranslatorInterface $translator;

    public function __construct(
        NotifierInterface $notifier,
        TranslatorInterface $translator
    ) {
        $this->notifier = $notifier;
        $this->translator = $translator;
    }

    public function __invoke(BrowserNotificationInterface $event): void
    {
        $notification = $this->buildNotification($event->asBrowserNotification());
        $this->notifier->send($notification, new NoRecipient());
    }

    /**
     * @return iterable<string>
     */
    public static function getHandledMessages(): iterable
    {
        yield AdminWasAuthenticated::class;
        yield AdminWasRemoved::class;
        yield AdminWasUpdated::class;
        yield AdminPasswordWasUpdated::class;

        yield ArticleWasCreated::class;
        yield ArticleWasPublished::class;
        yield ArticleWasRemoved::class;
        yield ArticleWasPublished::class;
        yield ArticleWasUnpublished::class;
        yield ArticleWasUpdated::class;

        yield CategoryWasCreated::class;
        yield CategoryWasUpdated::class;
        yield CategoryWasRemoved::class;

        yield ChannelWasCreated::class;
        yield ChannelWasUpdated::class;
        yield ChannelWasRemoved::class;
        yield ChannelWasPublished::class;
        yield ChannelWasClosed::class;

        yield PageWasCreated::class;
        yield PageWasUpdated::class;
        yield PageWasRemoved::class;
        yield PageWasPublished::class;
        yield PageWasUnpublished::class;
    }

    private function buildNotification(NotificationContext $context): Notification
    {
        $message = $this->translator->trans(
            sprintf('flash.admin.%s', $context->getMessage()),
            $context->getParameters(),
            'notification'
        );

        $notification = (new Notification($message, ['browser']))
            ->importance($context->getImportance());

        return $notification;
    }
}
