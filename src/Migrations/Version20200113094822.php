<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200113094822 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE city ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE glass_dump DROP CONSTRAINT fk_fafae6107cfd6b98');
        $this->addSql('DROP INDEX idx_fafae6107cfd6b98');
        $this->addSql('ALTER TABLE glass_dump ADD city_uuid VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE glass_dump ADD city_name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE glass_dump ADD country_code VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE glass_dump DROP city_uuid_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE city ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE glass_dump ADD city_uuid_id UUID NOT NULL');
        $this->addSql('ALTER TABLE glass_dump DROP city_uuid');
        $this->addSql('ALTER TABLE glass_dump DROP city_name');
        $this->addSql('ALTER TABLE glass_dump DROP country_code');
        $this->addSql('COMMENT ON COLUMN glass_dump.city_uuid_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE glass_dump ADD CONSTRAINT fk_fafae6107cfd6b98 FOREIGN KEY (city_uuid_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fafae6107cfd6b98 ON glass_dump (city_uuid_id)');
    }
}
