<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603190248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE credit_card (id INT AUTO_INCREMENT NOT NULL, cardholder_name VARCHAR(255) NOT NULL, card_number VARCHAR(255) NOT NULL, expiration_date DATETIME NOT NULL, cvv INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE paypal DROP cardholder_name, DROP card_number, DROP expiration_date, DROP cvv');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE credit_card');
        $this->addSql('ALTER TABLE paypal ADD cardholder_name VARCHAR(255) NOT NULL, ADD card_number VARCHAR(255) NOT NULL, ADD expiration_date DATETIME NOT NULL, ADD cvv INT NOT NULL');
    }
}
