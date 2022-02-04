<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface;
use Ramsey\Uuid\Uuid;

#[ORM\MappedSuperclass, ORM\Table(name: 'security_admin_recovery')]
class AdminPasswordRecovery implements PasswordRecoveryInterface
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'NONE'), ORM\Column(type: Types::GUID)]
    protected string $id;

    #[ORM\ManyToOne(targetEntity: UserInterface::class)]
    #[ORM\JoinColumn(name: 'user_id')]
    protected UserInterface $user;

    #[ORM\Column(type: Types::STRING, unique: true)]
    protected string $token;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected \DateTimeImmutable $creationDate;

    public function __construct()
    {
        $this->creationDate = new \DateTimeImmutable();
    }

    public function create(
        PasswordRecoveryId $id,
        UserInterface $user,
    ): PasswordRecoveryInterface {
        $this->id = $id->getValue();
        $this->user = $user;
        $this->token = Uuid::uuid6()->toString();

        return $this;
    }

    public function getId(): PasswordRecoveryId
    {
        return new PasswordRecoveryId($this->id);
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getCreationDate(): \Safe\DateTimeImmutable
    {
        return \Safe\DateTimeImmutable::createFromRegular($this->creationDate);
    }
}
