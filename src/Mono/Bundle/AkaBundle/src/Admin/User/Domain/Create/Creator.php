<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Exception\UnableToCreateException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Exception\AlreadyExistingUserException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Model\UserInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Repository\WriterInterface;

final class Creator implements CreatorInterface
{
    public function __construct(
        private WriterInterface $writer
    ) {
    }

    public function create(UserInterface $User): void
    {
        try {
            $this->writer->create($User);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingUserException($User->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException();
        }
    }
}
