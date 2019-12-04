<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204112223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rank_id_seq CASCADE');
        $this->addSql('CREATE TABLE city (id UUID NOT NULL, name VARCHAR(100) NOT NULL, county_code VARCHAR(10) NOT NULL, region VARCHAR(100) NOT NULL, mail_city VARCHAR(150) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN city.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE historic (id UUID NOT NULL, user_glassdump_uuid_id UUID NOT NULL, is_full BOOLEAN NOT NULL, is_dammage BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AD52EF563655294E ON historic (user_glassdump_uuid_id)');
        $this->addSql('COMMENT ON COLUMN historic.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN historic.user_glassdump_uuid_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE rank (id UUID NOT NULL, name VARCHAR(100) NOT NULL, avatar VARCHAR(255) NOT NULL, min_score INT NOT NULL, max_score INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_enable BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN rank.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE user_glassdump (id UUID NOT NULL, user_uuid_id UUID NOT NULL, glassdump_uuid_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2182CCCB99B8CBC0 ON user_glassdump (user_uuid_id)');
        $this->addSql('CREATE INDEX IDX_2182CCCBCE4A9265 ON user_glassdump (glassdump_uuid_id)');
        $this->addSql('COMMENT ON COLUMN user_glassdump.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_glassdump.user_uuid_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_glassdump.glassdump_uuid_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, username VARCHAR(100) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, adress VARCHAR(255) DEFAULT NULL, roles TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_enable BOOLEAN NOT NULL, score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.roles IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE historic ADD CONSTRAINT FK_AD52EF563655294E FOREIGN KEY (user_glassdump_uuid_id) REFERENCES user_glassdump (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_glassdump ADD CONSTRAINT FK_2182CCCB99B8CBC0 FOREIGN KEY (user_uuid_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_glassdump ADD CONSTRAINT FK_2182CCCBCE4A9265 FOREIGN KEY (glassdump_uuid_id) REFERENCES glass_dump (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE glass_dump ADD city_uuid_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN glass_dump.city_uuid_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE glass_dump ADD CONSTRAINT FK_FAFAE6107CFD6B98 FOREIGN KEY (city_uuid_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FAFAE6107CFD6B98 ON glass_dump (city_uuid_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE glass_dump DROP CONSTRAINT FK_FAFAE6107CFD6B98');
        $this->addSql('ALTER TABLE historic DROP CONSTRAINT FK_AD52EF563655294E');
        $this->addSql('ALTER TABLE user_glassdump DROP CONSTRAINT FK_2182CCCB99B8CBC0');
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rank_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE historic');
        $this->addSql('DROP TABLE rank');
        $this->addSql('DROP TABLE user_glassdump');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP INDEX IDX_FAFAE6107CFD6B98');
        $this->addSql('ALTER TABLE glass_dump DROP city_uuid_id');
    }
}
