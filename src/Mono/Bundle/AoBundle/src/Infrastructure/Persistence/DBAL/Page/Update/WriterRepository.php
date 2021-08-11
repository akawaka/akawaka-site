<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Persistence\DBAL\Page\Update;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Page\Domain\Operation\Update\Model\PageInterface;
use Mono\Component\Page\Domain\Operation\Update\Repository\WriterInterface;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function update(PageInterface $page): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('cms_page')
                ->set('name', ':name')
                ->set('slug', ':slug')
                ->set('content', ':content')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'name' => $page->getName(),
                    'slug' => $page->getSlug()->getValue(),
                    'content' => $page->getContent(),
                    'update' => (new \Safe\DateTimeImmutable())->format('Y-m-d H:i:s'),
                    'id' => $page->getId()->getValue(),
                ])
                ->execute()
            ;

            $builder
                ->delete('cms_page_spaces')
                ->where('page_id = :id')
                ->setParameters([
                    'id' => $page->getId()->getValue(),
                ])
                ->execute()
            ;

            foreach ($page->getSpaces() as $space) {
                $builder
                    ->insert('cms_page_spaces')
                    ->values([
                        'page_id' => ':id',
                        'space_id' => ':space',
                    ])
                    ->setParameters([
                        'id' => $page->getId()->getValue(),
                        'space' => $space,
                    ])
                    ->execute()
                ;
            }

            $this->getConnection()->commit();
        } catch (Exception $exception) {
            $this->getConnection()->rollback();

            return false;
        }

        return true;
    }
}
