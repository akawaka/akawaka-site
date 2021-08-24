<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Infrastructure\Persistence\DBAL\Page\Create;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Repository\WriterInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Model\SpaceInterface;

final class WriterRepository extends DBALRepository implements WriterInterface
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
                ->execute()
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
                    ->execute()
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
