<?php

declare(strict_types=1);

namespace App\Domain\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421033556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('alter table public."user" alter column deleted_at drop not null');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('alter table public."user" alter column deleted_at set not null');
    }
}
