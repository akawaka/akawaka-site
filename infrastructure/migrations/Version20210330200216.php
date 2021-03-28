<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330200216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cms_channel (id UUID NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, creation_date DATE NOT NULL, last_update DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN cms_channel.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_channel.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_channel.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE cms_page (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, creation_date DATE NOT NULL, last_update DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN cms_page.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_page.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_page.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE page_channels (page_id UUID NOT NULL, channel_id UUID NOT NULL, PRIMARY KEY(page_id, channel_id))');
        $this->addSql('CREATE INDEX IDX_738BE596C4663E4 ON page_channels (page_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_738BE59672F5A1AA ON page_channels (channel_id)');
        $this->addSql('COMMENT ON COLUMN page_channels.page_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN page_channels.channel_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE page_channels ADD CONSTRAINT FK_738BE596C4663E4 FOREIGN KEY (page_id) REFERENCES cms_page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE page_channels ADD CONSTRAINT FK_738BE59672F5A1AA FOREIGN KEY (channel_id) REFERENCES cms_channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE page_channels DROP CONSTRAINT FK_738BE59672F5A1AA');
        $this->addSql('ALTER TABLE page_channels DROP CONSTRAINT FK_738BE596C4663E4');
        $this->addSql('DROP TABLE cms_channel');
        $this->addSql('DROP TABLE cms_page');
        $this->addSql('DROP TABLE page_channels');
    }
}
