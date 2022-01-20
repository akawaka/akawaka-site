<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120222020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE security_admin_recovery ALTER creation_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER creation_date DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.creation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user_admin ALTER registration_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE user_admin ALTER registration_date DROP DEFAULT');
        $this->addSql('ALTER TABLE user_admin ALTER last_update TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE user_admin ALTER last_update DROP DEFAULT');
        $this->addSql('ALTER TABLE user_admin ALTER last_connection TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE user_admin ALTER last_connection DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN user_admin.registration_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.last_update IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.last_connection IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_admin ALTER registration_date TYPE DATE');
        $this->addSql('ALTER TABLE user_admin ALTER registration_date DROP DEFAULT');
        $this->addSql('ALTER TABLE user_admin ALTER last_update TYPE DATE');
        $this->addSql('ALTER TABLE user_admin ALTER last_update DROP DEFAULT');
        $this->addSql('ALTER TABLE user_admin ALTER last_connection TYPE DATE');
        $this->addSql('ALTER TABLE user_admin ALTER last_connection DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN user_admin.registration_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.last_connection IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER creation_date TYPE DATE');
        $this->addSql('ALTER TABLE security_admin_recovery ALTER creation_date DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.creation_date IS \'(DC2Type:date_immutable)\'');
    }
}
