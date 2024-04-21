<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421091332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            alter table public.mail_template
            add column type varchar(255) not null 
        ');

        $this->addSql("
                insert into public.mail_template(template, type)
                values (
                    '<div style=\"background-color: #000; font-family: Georgia, serif;\">
                         <h3 style=\"
                            text-align: center; 
                            padding: 40px; 
                            background-color: #000; 
                            color: #FFF;
                            font-size: 30px;
                            font-style: italic;
                         \">
                        Finish your registration
                    </h3>
                        <div style=\"margin: 30px 40px; padding-bottom: 30px\">
                            <section style=\"font-size: 18px; color: #FFF;\">
                                <p>
    Welcome to BM Furniture! We were thrilled to have you join our community. To complete your registration, please use the following confirmation code:
                                </p>
                                <p>
                                    <strong>Confirmation Code:<strong> [Your Confirmation Code]
                                </p>
                                <p>
    This code is valid for 24 hours. Please enter it in the confirmation section.
                                <p>
                                    If you have not registered for BM Furniture, please ignore this email.
                                </p>
                                <p>
    Thank you for choosing <span style=\"font-style: italic\">BM Furniture!</span>
                                </p>
                                <p style=\"text-align: right;\">
        Best regards, <span style=\"font-style: italic\">BM Furniture</span>
                                </p>
                            </section>
                            <div style=\"font-size: 14px; color: #FFF; text-align: center;\">
        This email was created automatically. <strong>Do not reply!<strong>
                            </div>
                        </div>
                    </div>',
                    'confirm_registration'
                )
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
            alter table public.mail_template
            drop column type
        ');
    }
}
