<?php

declare(strict_types=1);

namespace App\Domain\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240310034217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE mail_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mail_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE mail (id INT NOT NULL, mail_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, brand VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5126AC481FF10DFC ON mail (mail_type_id)');
        $this->addSql('CREATE TABLE mail_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC481FF10DFC FOREIGN KEY (mail_type_id) REFERENCES mail (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD status INT NOT NULL');
        $this->addSql("UPDATE product SET status = 1 ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE mail_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mail_type_id_seq CASCADE');
        $this->addSql('ALTER TABLE mail DROP CONSTRAINT FK_5126AC481FF10DFC');
        $this->addSql('DROP TABLE mail');
        $this->addSql('DROP TABLE mail_type');
        $this->addSql('ALTER TABLE product DROP status');
    }
}
