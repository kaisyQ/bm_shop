<?php

declare(strict_types=1);

namespace App\Domain\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430104024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            insert into 
                public.mail_template(template, deleted_at, type)
            values 
                (
                 '<div style=\"background-color: #000; font-family: Georgia, serif;\">
                         <h3 style=\"
                            text-align: center; 
                            padding: 40px; 
                            background-color: #000; 
                            color: #FFF;
                            font-size: 30px;
                            font-style: italic;
                         \">
                        Reset password
                    </h3>
                        <div style=\"margin: 30px 40px; padding-bottom: 30px; color: #FFF;\">
                            <section style=\"font-size: 18px; color: #FFF;\">
                                <p style=\"color: #FFF;\">
                                    <strong>New password:<strong> <span style=\"text-decoration: underline; text-transform: uppercase;\">{{password}}</span>
                                </p>
                                <p style=\"color: #FFF;\">
                                    If you did not request a password reset, please ignore this email or contact support if you have concerns.
                                </p>
                                <p style=\"text-align: right; color: #FFF;\">
        Best regards, <span style=\"font-style: italic\">BM Furniture</span>
                                </p>
                            </section>
                            <div style=\"font-size: 14px; color: #FFF; text-align: center;\">
        This email was created automatically. <strong>Do not reply!<strong>
                            </div>
                        </div>
                    </div>', 
                 null, 'refresh_password')
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("delete from public.mail_template where type = 'password_reset'");
    }
}
