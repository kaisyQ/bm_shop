<?php

declare(strict_types=1);

namespace App\Domain\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216035955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE log (id INT NOT NULL, message VARCHAR(255) NOT NULL, log_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE product ALTER width SET NOT NULL');
        $this->addSql('ALTER TABLE product ALTER height SET NOT NULL');
        $this->addSql('ALTER TABLE product ALTER depth SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE log_id_seq CASCADE');
        $this->addSql('DROP TABLE log');
        $this->addSql('ALTER TABLE product ALTER width DROP NOT NULL');
        $this->addSql('ALTER TABLE product ALTER height DROP NOT NULL');
        $this->addSql('ALTER TABLE product ALTER depth DROP NOT NULL');
    }
}
