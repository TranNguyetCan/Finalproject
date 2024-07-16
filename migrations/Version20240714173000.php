<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240714173000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discount CHANGE star_date start_date DATE NOT NULL');
        $this->addSql('ALTER TABLE used_voucher CHANGE use_at use_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE voucher CHANGE start_date start_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discount CHANGE start_date star_date DATE NOT NULL');
        $this->addSql('ALTER TABLE used_voucher CHANGE use_at use_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE voucher CHANGE start_date start_date DATETIME NOT NULL');
    }
}
