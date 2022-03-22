<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Article\Domain\Create\DataPersister\CreatePersisterInterface;
use App\Context\Admin\Article\Domain\Create\DataPersister\Model\ArticleInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class CreatePersisterRepository extends DBALRepository implements CreatePersisterInterface
{
    /**
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Safe\Exceptions\DatetimeException
     * @throws Exception
     */
    public function create(ArticleInterface $article): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->insert('ao_article')
                ->values([
                    'id' => ':id',
                    'slug' => ':slug',
                    'name' => ':name',
                    'status' => ':status',
                    'creation_date' => ':creation_date',
                ])
                ->setParameters([
                    'id' => $article->getId()->getValue(),
                    'slug' => $article->getSlug()->getValue(),
                    'name' => $article->getName(),
                    'status' => $article->getStatus(),
                    'creation_date' => $article->getCreationDate()->format('Y-m-d H:i:s'),
                ])
                ->executeQuery()
            ;

            foreach ($article->getCategories() as $category) {
                $builder
                    ->insert('ao_article_categories')
                    ->values([
                        'article_id' => ':id',
                        'category_id' => ':category',
                    ])
                    ->setParameters([
                        'id' => $article->getId()->getValue(),
                        'category' => $category,
                    ])
                    ->executeQuery()
                ;
            }

            foreach ($article->getAuthors() as $author) {
                $builder
                    ->insert('ao_article_authors')
                    ->values([
                        'article_id' => ':id',
                        'author_id' => ':author',
                    ])
                    ->setParameters([
                        'id' => $article->getId()->getValue(),
                        'author' => $author,
                    ])
                    ->executeQuery()
                ;
            }

            foreach ($article->getSpaces() as $space) {
                $builder
                    ->insert('ao_article_spaces')
                    ->values([
                        'article_id' => ':id',
                        'space_id' => ':space',
                    ])
                    ->setParameters([
                        'id' => $article->getId()->getValue(),
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
