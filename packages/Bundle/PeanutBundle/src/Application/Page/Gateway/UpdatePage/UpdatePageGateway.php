<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\UpdatePage;

use Black\Bundle\CoreBundle\Application\GatewayException;
use Black\Bundle\PeanutBundle\Application\Page\Command\CommandUpdatePage;
use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;
use Symfony\Component\Messenger\MessageBusInterface;

final class UpdatePageGateway
{
    private Instrumentation $instrumentation;

    private MessageBusInterface $commandBus;

    public function __construct(
        Instrumentation $instrumentation,
        MessageBusInterface $commandBus
    ) {
        $this->instrumentation = $instrumentation;
        $this->commandBus = $commandBus;
    }

    public function __invoke(UpdatePageRequest $request): UpdatePageResponse
    {
        $this->instrumentation->update($request);

        try {
            $this->commandBus->dispatch(new CommandUpdatePage(
                $request->getId(),
                $request->getName(),
                $request->getSlug(),
                $request->getContent()
            ));

            $response = new UpdatePageResponse(new PageId($request->getId()));
            $this->instrumentation->updated($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->notUpdated($request, $exception->getMessage());

            throw new GatewayException('Page not updated', $exception->getFile(), $exception->getMessage());
        }
    }
}
