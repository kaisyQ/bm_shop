<?php

declare(strict_types=1);

namespace App\Domain\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240406093927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE product_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');

        $this->addSql("
            INSERT INTO public.product_status(id, name) 
            VALUES 
                (1, 'available'),
                (2, 'pending'),
                (3, 'sold_out')
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE product_status_id_seq CASCADE');
        $this->addSql('DROP TABLE product_status');
    }
}
