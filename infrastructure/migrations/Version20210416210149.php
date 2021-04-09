<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416210149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cms_article_channels (article_id UUID NOT NULL, channel_id UUID NOT NULL, PRIMARY KEY(article_id, channel_id))');
        $this->addSql('CREATE INDEX IDX_36E3F7A77294869C ON cms_article_channels (article_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36E3F7A772F5A1AA ON cms_article_channels (channel_id)');
        $this->addSql('COMMENT ON COLUMN cms_article_channels.article_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_article_channels.channel_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE cms_article_channels ADD CONSTRAINT FK_36E3F7A77294869C FOREIGN KEY (article_id) REFERENCES cms_article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_channels ADD CONSTRAINT FK_36E3F7A772F5A1AA FOREIGN KEY (channel_id) REFERENCES cms_channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE page_channels');
        $this->addSql('DROP INDEX uniq_5cd601775e237e06');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5CD60177989D9B62 ON cms_article (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE page_channels (page_id UUID NOT NULL, channel_id UUID NOT NULL, PRIMARY KEY(page_id, channel_id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_738be59672f5a1aa ON page_channels (channel_id)');
        $this->addSql('CREATE INDEX idx_738be596c4663e4 ON page_channels (page_id)');
        $this->addSql('COMMENT ON COLUMN page_channels.page_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN page_channels.channel_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE page_channels ADD CONSTRAINT fk_738be596c4663e4 FOREIGN KEY (page_id) REFERENCES cms_article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE page_channels ADD CONSTRAINT fk_738be59672f5a1aa FOREIGN KEY (channel_id) REFERENCES cms_channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE cms_article_channels');
        $this->addSql('DROP INDEX UNIQ_5CD60177989D9B62');
        $this->addSql('CREATE UNIQUE INDEX uniq_5cd601775e237e06 ON cms_article (name)');
    }
}
