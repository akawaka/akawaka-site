<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416214752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_categories DROP CONSTRAINT FK_62A97E97294869C');
        $this->addSql('ALTER TABLE article_categories DROP CONSTRAINT FK_62A97E912469DE2');
        $this->addSql('DROP INDEX uniq_62a97e912469de2');
        $this->addSql('ALTER TABLE article_categories ADD CONSTRAINT FK_62A97E97294869C FOREIGN KEY (article_id) REFERENCES cms_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_categories ADD CONSTRAINT FK_62A97E912469DE2 FOREIGN KEY (category_id) REFERENCES cms_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_62A97E912469DE2 ON article_categories (category_id)');
        $this->addSql('ALTER TABLE cms_article_channels DROP CONSTRAINT FK_36E3F7A77294869C');
        $this->addSql('ALTER TABLE cms_article_channels DROP CONSTRAINT FK_36E3F7A772F5A1AA');
        $this->addSql('DROP INDEX uniq_36e3f7a772f5a1aa');
        $this->addSql('ALTER TABLE cms_article_channels ADD CONSTRAINT FK_36E3F7A77294869C FOREIGN KEY (article_id) REFERENCES cms_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_channels ADD CONSTRAINT FK_36E3F7A772F5A1AA FOREIGN KEY (channel_id) REFERENCES cms_channel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_36E3F7A772F5A1AA ON cms_article_channels (channel_id)');
        $this->addSql('ALTER TABLE cms_page_channels DROP CONSTRAINT FK_C3DA5E43C4663E4');
        $this->addSql('ALTER TABLE cms_page_channels DROP CONSTRAINT FK_C3DA5E4372F5A1AA');
        $this->addSql('DROP INDEX uniq_c3da5e4372f5a1aa');
        $this->addSql('ALTER TABLE cms_page_channels ADD CONSTRAINT FK_C3DA5E43C4663E4 FOREIGN KEY (page_id) REFERENCES cms_page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_page_channels ADD CONSTRAINT FK_C3DA5E4372F5A1AA FOREIGN KEY (channel_id) REFERENCES cms_channel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C3DA5E4372F5A1AA ON cms_page_channels (channel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_categories DROP CONSTRAINT fk_62a97e97294869c');
        $this->addSql('ALTER TABLE article_categories DROP CONSTRAINT fk_62a97e912469de2');
        $this->addSql('DROP INDEX IDX_62A97E912469DE2');
        $this->addSql('ALTER TABLE article_categories ADD CONSTRAINT fk_62a97e97294869c FOREIGN KEY (article_id) REFERENCES cms_article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_categories ADD CONSTRAINT fk_62a97e912469de2 FOREIGN KEY (category_id) REFERENCES cms_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_62a97e912469de2 ON article_categories (category_id)');
        $this->addSql('ALTER TABLE cms_page_channels DROP CONSTRAINT fk_c3da5e43c4663e4');
        $this->addSql('ALTER TABLE cms_page_channels DROP CONSTRAINT fk_c3da5e4372f5a1aa');
        $this->addSql('DROP INDEX IDX_C3DA5E4372F5A1AA');
        $this->addSql('ALTER TABLE cms_page_channels ADD CONSTRAINT fk_c3da5e43c4663e4 FOREIGN KEY (page_id) REFERENCES cms_page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_page_channels ADD CONSTRAINT fk_c3da5e4372f5a1aa FOREIGN KEY (channel_id) REFERENCES cms_channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_c3da5e4372f5a1aa ON cms_page_channels (channel_id)');
        $this->addSql('ALTER TABLE cms_article_channels DROP CONSTRAINT fk_36e3f7a77294869c');
        $this->addSql('ALTER TABLE cms_article_channels DROP CONSTRAINT fk_36e3f7a772f5a1aa');
        $this->addSql('DROP INDEX IDX_36E3F7A772F5A1AA');
        $this->addSql('ALTER TABLE cms_article_channels ADD CONSTRAINT fk_36e3f7a77294869c FOREIGN KEY (article_id) REFERENCES cms_article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_channels ADD CONSTRAINT fk_36e3f7a772f5a1aa FOREIGN KEY (channel_id) REFERENCES cms_channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_36e3f7a772f5a1aa ON cms_article_channels (channel_id)');
    }
}
