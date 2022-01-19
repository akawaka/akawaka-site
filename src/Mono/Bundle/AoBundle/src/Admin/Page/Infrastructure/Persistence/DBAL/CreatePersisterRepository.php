<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class CreatePersisterRepository extends DBALRepository implements CreatePersisterInterface
{
    public function create(PageInterface $page): bool
    {
        $this->beginTransaction();

        $spaces = $page->getSpaces()->map(function (SpaceInterface $space) {
            return $space->getId()->getValue();
        });

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->insert('ao_page')
                ->values([
                    'id' => ':id',
                    'slug' => ':slug',
                    'name' => ':name',
                    'status' => ':status',
                    'creation_date' => ':creation_date',
                ])
                ->setParameters([
                    'id' => $page->getId()->getValue(),
                    'slug' => $page->getSlug()->getValue(),
                    'name' => $page->getName(),
                    'status' => $page->getStatus(),
                    'creation_date' => $page->getCreationDate()->format('Y-m-d H:i:s'),
                ])
                ->executeQuery()
            ;

            foreach ($spaces as $space) {
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

            throw $exception;
        }

        return true;
    }
}
