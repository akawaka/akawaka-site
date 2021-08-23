<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210811215759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cms_article (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5CD601775E237E06 ON cms_article (name)');
        $this->addSql('COMMENT ON COLUMN cms_article.creation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_article.last_update IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE cms_article_categories (article_id UUID NOT NULL, category_id UUID NOT NULL, PRIMARY KEY(article_id, category_id))');
        $this->addSql('CREATE INDEX IDX_4F744647294869C ON cms_article_categories (article_id)');
        $this->addSql('CREATE INDEX IDX_4F7446412469DE2 ON cms_article_categories (category_id)');
        $this->addSql('CREATE TABLE cms_article_authors (article_id UUID NOT NULL, author_id UUID NOT NULL, PRIMARY KEY(article_id, author_id))');
        $this->addSql('CREATE INDEX IDX_C32285E97294869C ON cms_article_authors (article_id)');
        $this->addSql('CREATE INDEX IDX_C32285E9F675F31B ON cms_article_authors (author_id)');
        $this->addSql('CREATE TABLE cms_author (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F59C7B05E237E06 ON cms_author (name)');
        $this->addSql('CREATE TABLE cms_category (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6CA2D53C5E237E06 ON cms_category (name)');
        $this->addSql('CREATE TABLE cms_page (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D39C1B5D5E237E06 ON cms_page (name)');
        $this->addSql('COMMENT ON COLUMN cms_page.creation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_page.last_update IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE cms_space (id UUID NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, status VARCHAR(255) NOT NULL, theme VARCHAR(255) DEFAULT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7015A1677153098 ON cms_space (code)');
        $this->addSql('COMMENT ON COLUMN cms_space.creation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_space.last_update IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE security_admin_recovery (id UUID NOT NULL, user_id UUID DEFAULT NULL, token VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D6540125F37A13B ON security_admin_recovery (token)');
        $this->addSql('CREATE INDEX IDX_9D654012A76ED395 ON security_admin_recovery (user_id)');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE user_admin (id UUID NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, registration_date DATE NOT NULL, last_update DATE DEFAULT NULL, last_connection DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6ACCF62EF85E0677 ON user_admin (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6ACCF62EE7927C74 ON user_admin (email)');
        $this->addSql('COMMENT ON COLUMN user_admin.registration_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.last_connection IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE cms_article_categories ADD CONSTRAINT FK_4F744647294869C FOREIGN KEY (article_id) REFERENCES cms_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_categories ADD CONSTRAINT FK_4F7446412469DE2 FOREIGN KEY (category_id) REFERENCES cms_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_authors ADD CONSTRAINT FK_C32285E97294869C FOREIGN KEY (article_id) REFERENCES cms_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_authors ADD CONSTRAINT FK_C32285E9F675F31B FOREIGN KEY (author_id) REFERENCES cms_author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE security_admin_recovery ADD CONSTRAINT FK_9D654012A76ED395 FOREIGN KEY (user_id) REFERENCES user_admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cms_article_categories DROP CONSTRAINT FK_4F744647294869C');
        $this->addSql('ALTER TABLE cms_article_authors DROP CONSTRAINT FK_C32285E97294869C');
        $this->addSql('ALTER TABLE cms_article_categories DROP CONSTRAINT FK_4F7446412469DE2');
        $this->addSql('ALTER TABLE cms_article_authors DROP CONSTRAINT FK_C32285E9F675F31B');
        $this->addSql('ALTER TABLE security_admin_recovery DROP CONSTRAINT FK_9D654012A76ED395');
        $this->addSql('DROP TABLE cms_article');
        $this->addSql('DROP TABLE cms_article_categories');
        $this->addSql('DROP TABLE cms_article_authors');
        $this->addSql('DROP TABLE cms_author');
        $this->addSql('DROP TABLE cms_category');
        $this->addSql('DROP TABLE cms_page');
        $this->addSql('DROP TABLE cms_space');
        $this->addSql('DROP TABLE security_admin_recovery');
        $this->addSql('DROP TABLE user_admin');
    }
}
