<?php

declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026094616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attachment_product DROP CONSTRAINT fk_1bdf512b464e68b');
        $this->addSql('ALTER TABLE attachment_product DROP CONSTRAINT fk_1bdf512b4584665a');
        $this->addSql('DROP TABLE attachment_product');
        $this->addSql('ALTER TABLE attachment ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BB4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_795FD9BB4584665A ON attachment (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE attachment_product (attachment_id VARCHAR(255) NOT NULL, product_id INT NOT NULL, PRIMARY KEY(attachment_id, product_id))');
        $this->addSql('CREATE INDEX idx_1bdf512b4584665a ON attachment_product (product_id)');
        $this->addSql('CREATE INDEX idx_1bdf512b464e68b ON attachment_product (attachment_id)');
        $this->addSql('ALTER TABLE attachment_product ADD CONSTRAINT fk_1bdf512b464e68b FOREIGN KEY (attachment_id) REFERENCES attachment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attachment_product ADD CONSTRAINT fk_1bdf512b4584665a FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attachment DROP CONSTRAINT FK_795FD9BB4584665A');
        $this->addSql('DROP INDEX IDX_795FD9BB4584665A');
        $this->addSql('ALTER TABLE attachment DROP product_id');
    }
}
