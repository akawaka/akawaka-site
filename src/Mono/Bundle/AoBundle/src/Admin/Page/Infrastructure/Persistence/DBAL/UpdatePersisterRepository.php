<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Update\DataPersister\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class UpdatePersisterRepository extends DBALRepository implements UpdatePersisterInterface
{
    public function update(PageInterface $page): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_page')
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
                ->executeQuery()
            ;

            $builder
                ->delete('ao_page_spaces')
                ->where('page_id = :id')
                ->setParameters([
                    'id' => $page->getId()->getValue(),
                ])
                ->executeQuery()
            ;

            foreach ($page->getSpaces() as $space) {
                $builder
                    ->insert('ao_page_spaces')
                    ->values([
                        'page_id' => ':id',
                        'space_id' => ':space',
                    ])
                    ->setParameters([
                        'id' => $page->getId()->getValue(),
                        'space' => $space,
                    ])
                    ->executeQuery()
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
