<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824203305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ao_article (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, status VARCHAR(255) NOT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4D25793F5E237E06 ON ao_article (name)');
        $this->addSql('COMMENT ON COLUMN ao_article.creation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN ao_article.last_update IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE ao_article_categories (article_id UUID NOT NULL, category_id UUID NOT NULL, PRIMARY KEY(article_id, category_id))');
        $this->addSql('CREATE INDEX IDX_9288B7487294869C ON ao_article_categories (article_id)');
        $this->addSql('CREATE INDEX IDX_9288B74812469DE2 ON ao_article_categories (category_id)');
        $this->addSql('CREATE TABLE ao_article_authors (article_id UUID NOT NULL, author_id UUID NOT NULL, PRIMARY KEY(article_id, author_id))');
        $this->addSql('CREATE INDEX IDX_285B17787294869C ON ao_article_authors (article_id)');
        $this->addSql('CREATE INDEX IDX_285B1778F675F31B ON ao_article_authors (author_id)');
        $this->addSql('CREATE TABLE ao_article_spaces (article_id UUID NOT NULL, space_id UUID NOT NULL, PRIMARY KEY(article_id, space_id))');
        $this->addSql('CREATE INDEX IDX_36412ADD7294869C ON ao_article_spaces (article_id)');
        $this->addSql('CREATE INDEX IDX_36412ADD23575340 ON ao_article_spaces (space_id)');
        $this->addSql('CREATE TABLE ao_author (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D2AD36B5E237E06 ON ao_author (name)');
        $this->addSql('CREATE TABLE ao_category (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_14B4EFE65E237E06 ON ao_category (name)');
        $this->addSql('CREATE TABLE ao_page (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, status VARCHAR(255) NOT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C60214865E237E06 ON ao_page (name)');
        $this->addSql('COMMENT ON COLUMN ao_page.creation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN ao_page.last_update IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE ao_page_spaces (page_id UUID NOT NULL, space_id UUID NOT NULL, PRIMARY KEY(page_id, space_id))');
        $this->addSql('CREATE INDEX IDX_7E7FFE04C4663E4 ON ao_page_spaces (page_id)');
        $this->addSql('CREATE INDEX IDX_7E7FFE0423575340 ON ao_page_spaces (space_id)');
        $this->addSql('CREATE TABLE ao_space (id UUID NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, status VARCHAR(255) NOT NULL, theme VARCHAR(255) DEFAULT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1615CF4577153098 ON ao_space (code)');
        $this->addSql('COMMENT ON COLUMN ao_space.creation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN ao_space.last_update IS \'(DC2Type:datetime_immutable)\'');
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
        $this->addSql('ALTER TABLE ao_article_categories ADD CONSTRAINT FK_9288B7487294869C FOREIGN KEY (article_id) REFERENCES ao_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ao_article_categories ADD CONSTRAINT FK_9288B74812469DE2 FOREIGN KEY (category_id) REFERENCES ao_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ao_article_authors ADD CONSTRAINT FK_285B17787294869C FOREIGN KEY (article_id) REFERENCES ao_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ao_article_authors ADD CONSTRAINT FK_285B1778F675F31B FOREIGN KEY (author_id) REFERENCES ao_author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ao_article_spaces ADD CONSTRAINT FK_36412ADD7294869C FOREIGN KEY (article_id) REFERENCES ao_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ao_article_spaces ADD CONSTRAINT FK_36412ADD23575340 FOREIGN KEY (space_id) REFERENCES ao_space (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ao_page_spaces ADD CONSTRAINT FK_7E7FFE04C4663E4 FOREIGN KEY (page_id) REFERENCES ao_page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ao_page_spaces ADD CONSTRAINT FK_7E7FFE0423575340 FOREIGN KEY (space_id) REFERENCES ao_space (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE security_admin_recovery ADD CONSTRAINT FK_9D654012A76ED395 FOREIGN KEY (user_id) REFERENCES user_admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ao_article_categories DROP CONSTRAINT FK_9288B7487294869C');
        $this->addSql('ALTER TABLE ao_article_authors DROP CONSTRAINT FK_285B17787294869C');
        $this->addSql('ALTER TABLE ao_article_spaces DROP CONSTRAINT FK_36412ADD7294869C');
        $this->addSql('ALTER TABLE ao_article_authors DROP CONSTRAINT FK_285B1778F675F31B');
        $this->addSql('ALTER TABLE ao_article_categories DROP CONSTRAINT FK_9288B74812469DE2');
        $this->addSql('ALTER TABLE ao_page_spaces DROP CONSTRAINT FK_7E7FFE04C4663E4');
        $this->addSql('ALTER TABLE ao_article_spaces DROP CONSTRAINT FK_36412ADD23575340');
        $this->addSql('ALTER TABLE ao_page_spaces DROP CONSTRAINT FK_7E7FFE0423575340');
        $this->addSql('ALTER TABLE security_admin_recovery DROP CONSTRAINT FK_9D654012A76ED395');
        $this->addSql('DROP TABLE ao_article');
        $this->addSql('DROP TABLE ao_article_categories');
        $this->addSql('DROP TABLE ao_article_authors');
        $this->addSql('DROP TABLE ao_article_spaces');
        $this->addSql('DROP TABLE ao_author');
        $this->addSql('DROP TABLE ao_category');
        $this->addSql('DROP TABLE ao_page');
        $this->addSql('DROP TABLE ao_page_spaces');
        $this->addSql('DROP TABLE ao_space');
        $this->addSql('DROP TABLE security_admin_recovery');
        $this->addSql('DROP TABLE user_admin');
    }
}
