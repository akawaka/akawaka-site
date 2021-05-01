<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410205605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cms_article (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, creation_date DATE NOT NULL, last_update DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5CD601775E237E06 ON cms_article (name)');
        $this->addSql('COMMENT ON COLUMN cms_article.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_article.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_article.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE article_categories (article_id UUID NOT NULL, category_id UUID NOT NULL, PRIMARY KEY(article_id, category_id))');
        $this->addSql('CREATE INDEX IDX_62A97E97294869C ON article_categories (article_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_62A97E912469DE2 ON article_categories (category_id)');
        $this->addSql('COMMENT ON COLUMN article_categories.article_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN article_categories.category_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE page_channels (page_id UUID NOT NULL, channel_id UUID NOT NULL, PRIMARY KEY(page_id, channel_id))');
        $this->addSql('CREATE INDEX IDX_738BE596C4663E4 ON page_channels (page_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_738BE59672F5A1AA ON page_channels (channel_id)');
        $this->addSql('COMMENT ON COLUMN page_channels.page_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN page_channels.channel_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE cms_category (id UUID NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6CA2D53C989D9B62 ON cms_category (slug)');
        $this->addSql('COMMENT ON COLUMN cms_category.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE cms_channel (id UUID NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, creation_date DATE NOT NULL, last_update DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FC15815677153098 ON cms_channel (code)');
        $this->addSql('COMMENT ON COLUMN cms_channel.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_channel.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_channel.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE cms_page (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, creation_date DATE NOT NULL, last_update DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D39C1B5D5E237E06 ON cms_page (name)');
        $this->addSql('COMMENT ON COLUMN cms_page.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_page.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_page.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE cms_page_channels (page_id UUID NOT NULL, channel_id UUID NOT NULL, PRIMARY KEY(page_id, channel_id))');
        $this->addSql('CREATE INDEX IDX_C3DA5E43C4663E4 ON cms_page_channels (page_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C3DA5E4372F5A1AA ON cms_page_channels (channel_id)');
        $this->addSql('COMMENT ON COLUMN cms_page_channels.page_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_page_channels.channel_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE article_categories ADD CONSTRAINT FK_62A97E97294869C FOREIGN KEY (article_id) REFERENCES cms_article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_categories ADD CONSTRAINT FK_62A97E912469DE2 FOREIGN KEY (category_id) REFERENCES cms_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE page_channels ADD CONSTRAINT FK_738BE596C4663E4 FOREIGN KEY (page_id) REFERENCES cms_article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE page_channels ADD CONSTRAINT FK_738BE59672F5A1AA FOREIGN KEY (channel_id) REFERENCES cms_channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_page_channels ADD CONSTRAINT FK_C3DA5E43C4663E4 FOREIGN KEY (page_id) REFERENCES cms_page (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_page_channels ADD CONSTRAINT FK_C3DA5E4372F5A1AA FOREIGN KEY (channel_id) REFERENCES cms_channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_categories DROP CONSTRAINT FK_62A97E97294869C');
        $this->addSql('ALTER TABLE page_channels DROP CONSTRAINT FK_738BE596C4663E4');
        $this->addSql('ALTER TABLE article_categories DROP CONSTRAINT FK_62A97E912469DE2');
        $this->addSql('ALTER TABLE page_channels DROP CONSTRAINT FK_738BE59672F5A1AA');
        $this->addSql('ALTER TABLE cms_page_channels DROP CONSTRAINT FK_C3DA5E4372F5A1AA');
        $this->addSql('ALTER TABLE cms_page_channels DROP CONSTRAINT FK_C3DA5E43C4663E4');
        $this->addSql('DROP TABLE cms_article');
        $this->addSql('DROP TABLE article_categories');
        $this->addSql('DROP TABLE page_channels');
        $this->addSql('DROP TABLE cms_category');
        $this->addSql('DROP TABLE cms_channel');
        $this->addSql('DROP TABLE cms_page');
        $this->addSql('DROP TABLE cms_page_channels');
    }
}
