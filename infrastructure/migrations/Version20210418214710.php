<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210418214710 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_admin (id UUID NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, registration_date DATE NOT NULL, last_update DATE DEFAULT NULL, last_connection DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6ACCF62EF85E0677 ON user_admin (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6ACCF62EE7927C74 ON user_admin (email)');
        $this->addSql('COMMENT ON COLUMN user_admin.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.registration_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.last_update IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_admin.last_connection IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_admin');
    }
}
