<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210506215237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cms_article ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE cms_article ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_article.id IS NULL');
        $this->addSql('ALTER TABLE article_categories ALTER article_id TYPE UUID');
        $this->addSql('ALTER TABLE article_categories ALTER article_id DROP DEFAULT');
        $this->addSql('ALTER TABLE article_categories ALTER category_id TYPE UUID');
        $this->addSql('ALTER TABLE article_categories ALTER category_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN article_categories.article_id IS NULL');
        $this->addSql('COMMENT ON COLUMN article_categories.category_id IS NULL');
        $this->addSql('ALTER TABLE cms_article_channels ALTER article_id TYPE UUID');
        $this->addSql('ALTER TABLE cms_article_channels ALTER article_id DROP DEFAULT');
        $this->addSql('ALTER TABLE cms_article_channels ALTER channel_id TYPE UUID');
        $this->addSql('ALTER TABLE cms_article_channels ALTER channel_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_article_channels.article_id IS NULL');
        $this->addSql('COMMENT ON COLUMN cms_article_channels.channel_id IS NULL');
        $this->addSql('ALTER TABLE cms_category ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE cms_category ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_category.id IS NULL');
        $this->addSql('ALTER TABLE cms_channel ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE cms_channel ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_channel.id IS NULL');
        $this->addSql('DROP INDEX uniq_d39c1b5d5e237e06');
        $this->addSql('ALTER TABLE cms_page ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE cms_page ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_page.id IS NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D39C1B5D989D9B62 ON cms_page (slug)');
        $this->addSql('ALTER TABLE cms_page_channels ALTER page_id TYPE UUID');
        $this->addSql('ALTER TABLE cms_page_channels ALTER page_id DROP DEFAULT');
        $this->addSql('ALTER TABLE cms_page_channels ALTER channel_id TYPE UUID');
        $this->addSql('ALTER TABLE cms_page_channels ALTER channel_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_page_channels.page_id IS NULL');
        $this->addSql('COMMENT ON COLUMN cms_page_channels.channel_id IS NULL');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER user_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.id IS NULL');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.user_id IS NULL');
        $this->addSql('ALTER TABLE user_admin ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_admin ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN user_admin.id IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cms_article ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE cms_article ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_article.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE article_categories ALTER article_id TYPE UUID');
        $this->addSql('ALTER TABLE article_categories ALTER article_id DROP DEFAULT');
        $this->addSql('ALTER TABLE article_categories ALTER category_id TYPE UUID');
        $this->addSql('ALTER TABLE article_categories ALTER category_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN article_categories.article_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN article_categories.category_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE cms_category ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE cms_category ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_category.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE cms_channel ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE cms_channel ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_channel.id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP INDEX UNIQ_D39C1B5D989D9B62');
        $this->addSql('ALTER TABLE cms_page ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE cms_page ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_page.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX uniq_d39c1b5d5e237e06 ON cms_page (name)');
        $this->addSql('ALTER TABLE cms_page_channels ALTER page_id TYPE UUID');
        $this->addSql('ALTER TABLE cms_page_channels ALTER page_id DROP DEFAULT');
        $this->addSql('ALTER TABLE cms_page_channels ALTER channel_id TYPE UUID');
        $this->addSql('ALTER TABLE cms_page_channels ALTER channel_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_page_channels.page_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_page_channels.channel_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER user_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE cms_article_channels ALTER article_id TYPE UUID');
        $this->addSql('ALTER TABLE cms_article_channels ALTER article_id DROP DEFAULT');
        $this->addSql('ALTER TABLE cms_article_channels ALTER channel_id TYPE UUID');
        $this->addSql('ALTER TABLE cms_article_channels ALTER channel_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN cms_article_channels.article_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cms_article_channels.channel_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE user_admin ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_admin ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN user_admin.id IS \'(DC2Type:uuid)\'');
    }
}
