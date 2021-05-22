<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210522210837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cms_page_channels DROP CONSTRAINT fk_c3da5e4372f5a1aa');
        $this->addSql('ALTER TABLE cms_article_channels DROP CONSTRAINT fk_36e3f7a772f5a1aa');
        $this->addSql('CREATE TABLE cms_article_spaces (article_id UUID NOT NULL, space_id UUID NOT NULL, PRIMARY KEY(article_id, space_id))');
        $this->addSql('CREATE INDEX IDX_41E584187294869C ON cms_article_spaces (article_id)');
        $this->addSql('CREATE INDEX IDX_41E5841823575340 ON cms_article_spaces (space_id)');
        $this->addSql('CREATE TABLE cms_page_spaces (page_id UUID NOT NULL, space_id UUID NOT NULL, PRIMARY KEY(page_id, space_id))');
        $this->addSql('CREATE INDEX IDX_2F1C25B2C4663E4 ON cms_page_spaces (page_id)');
        $this->addSql('CREATE INDEX IDX_2F1C25B223575340 ON cms_page_spaces (space_id)');
        $this->addSql('CREATE TABLE cms_space (id UUID NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, theme VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, creation_date DATE NOT NULL, last_update DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7015A1677153098 ON cms_space (code)');
        $this->addSql('COMMENT ON COLUMN cms_space.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_space.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE cms_article_spaces ADD CONSTRAINT FK_41E584187294869C FOREIGN KEY (article_id) REFERENCES cms_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_spaces ADD CONSTRAINT FK_41E5841823575340 FOREIGN KEY (space_id) REFERENCES cms_space (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_page_spaces ADD CONSTRAINT FK_2F1C25B2C4663E4 FOREIGN KEY (page_id) REFERENCES cms_page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_page_spaces ADD CONSTRAINT FK_2F1C25B223575340 FOREIGN KEY (space_id) REFERENCES cms_space (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE cms_page_channels');
        $this->addSql('DROP TABLE cms_article_channels');
        $this->addSql('DROP TABLE cms_channel');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cms_article_spaces DROP CONSTRAINT FK_41E5841823575340');
        $this->addSql('ALTER TABLE cms_page_spaces DROP CONSTRAINT FK_2F1C25B223575340');
        $this->addSql('CREATE TABLE cms_page_channels (page_id UUID NOT NULL, channel_id UUID NOT NULL, PRIMARY KEY(page_id, channel_id))');
        $this->addSql('CREATE INDEX idx_c3da5e43c4663e4 ON cms_page_channels (page_id)');
        $this->addSql('CREATE INDEX idx_c3da5e4372f5a1aa ON cms_page_channels (channel_id)');
        $this->addSql('CREATE TABLE cms_article_channels (article_id UUID NOT NULL, channel_id UUID NOT NULL, PRIMARY KEY(article_id, channel_id))');
        $this->addSql('CREATE INDEX idx_36e3f7a77294869c ON cms_article_channels (article_id)');
        $this->addSql('CREATE INDEX idx_36e3f7a772f5a1aa ON cms_article_channels (channel_id)');
        $this->addSql('CREATE TABLE cms_channel (id UUID NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, creation_date DATE NOT NULL, last_update DATE DEFAULT NULL, theme VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_fc15815677153098 ON cms_channel (code)');
        $this->addSql('COMMENT ON COLUMN cms_channel.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cms_channel.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE cms_page_channels ADD CONSTRAINT fk_c3da5e43c4663e4 FOREIGN KEY (page_id) REFERENCES cms_page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_page_channels ADD CONSTRAINT fk_c3da5e4372f5a1aa FOREIGN KEY (channel_id) REFERENCES cms_channel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_channels ADD CONSTRAINT fk_36e3f7a77294869c FOREIGN KEY (article_id) REFERENCES cms_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cms_article_channels ADD CONSTRAINT fk_36e3f7a772f5a1aa FOREIGN KEY (channel_id) REFERENCES cms_channel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE cms_article_spaces');
        $this->addSql('DROP TABLE cms_page_spaces');
        $this->addSql('DROP TABLE cms_space');
    }
}
