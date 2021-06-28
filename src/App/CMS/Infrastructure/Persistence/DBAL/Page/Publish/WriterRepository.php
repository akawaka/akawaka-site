<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Page\Publish;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use App\CMS\Domain\Page\Operation\Publish\WriterInterface;
use App\CMS\Domain\Page\Common\Enum\StatusEnum;
use Mono\Component\Page\Domain\Common\Identifier\PageId;

class WriterRepository extends DBALRepository implements WriterInterface
{
    public function publish(PageId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('cms_page')
                ->set('status', ':status')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'status' => StatusEnum::PUBLISHED,
                    'update' => (new \Safe\DateTimeImmutable())->format('Y-m-d H:i:s'),
                    'id' => $id->getValue(),
                ])
                ->execute()
            ;

            $this->getConnection()->commit();
        } catch (Exception $exception) {
            $this->getConnection()->rollback();

            return false;
        }

        return true;
    }
}
