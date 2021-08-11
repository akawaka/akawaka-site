<?php

declare(strict_types=1);

namespace Mono\Component\Page\Infrastructure\Persistence\DBAL\Create;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Page\Domain\Operation\Create\Model\PageInterface;
use Mono\Component\Page\Domain\Operation\Create\Repository\WriterInterface;

class WriterRepository extends DBALRepository implements WriterInterface
{
    public function create(PageInterface $page): bool
    {
        $this->beginTransaction();
        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->insert('cms_page')
                ->values([
                    'id' => ':id',
                    'slug' => ':slug',
                    'name' => ':name',
                    'creation_date' => ':creation_date',
                ])
                ->setParameters([
                    'id' => $page->getId()->getValue(),
                    'slug' => $page->getSlug()->getValue(),
                    'name' => $page->getName(),
                    'creation_date' => $page->getCreationDate()->format('Y-m-d H:i:s'),
                ])
                ->execute()
            ;

            $this->getConnection()->commit();
        } catch (Exception $exception) {
            $this->getConnection()->rollback();

            throw $exception;
        }

        return true;
    }
}
