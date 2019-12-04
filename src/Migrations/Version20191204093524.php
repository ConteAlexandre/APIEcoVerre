<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204093524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE test_id_seq CASCADE');
        $this->addSql('CREATE TABLE glass_dump (id UUID NOT NULL, number_borne INT DEFAULT NULL, volume INT DEFAULT NULL, landmark VARCHAR(255) DEFAULT NULL, collect_day VARCHAR(10) DEFAULT NULL, coordonate geography(POINT, 4326) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, dammage BOOLEAN NOT NULL, is_full BOOLEAN NOT NULL, is_enable BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN glass_dump.id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE test_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE glass_dump');
    }
}
