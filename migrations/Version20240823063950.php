<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240823063950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE total total NUMERIC(10, 2) NOT NULL, CHANGE delivery_local delivery_local VARCHAR(255) NOT NULL, CHANGE cus_name cus_name VARCHAR(255) NOT NULL, CHANGE cus_phone cus_phone INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient DROP name');
        $this->addSql('ALTER TABLE `order` CHANGE delivery_local delivery_local VARCHAR(255) DEFAULT NULL, CHANGE total total NUMERIC(10, 2) DEFAULT NULL, CHANGE cus_name cus_name VARCHAR(255) DEFAULT NULL, CHANGE cus_phone cus_phone INT DEFAULT NULL');
    }
}
