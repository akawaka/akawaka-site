<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210501133256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE security_admin_recovery (id UUID NOT NULL, user_id UUID DEFAULT NULL, token VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D6540125F37A13B ON security_admin_recovery (token)');
        $this->addSql('CREATE INDEX IDX_9D654012A76ED395 ON security_admin_recovery (user_id)');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN security_admin_recovery.creation_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE security_admin_recovery ADD CONSTRAINT FK_9D654012A76ED395 FOREIGN KEY (user_id) REFERENCES user_admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE security_admin_recovery');
    }
}
