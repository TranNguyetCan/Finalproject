<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601145243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE used_voucher (id INT AUTO_INCREMENT NOT NULL, cus_name VARCHAR(255) NOT NULL, voucher VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voucher (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, deal INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_1392A5D84584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voucher ADD CONSTRAINT FK_1392A5D84584665A FOREIGN KEY (product_id) REFERENCES pro_size (id)');
        $this->addSql('DROP INDEX abc ON discount');
        $this->addSql('ALTER TABLE discount ADD discount_code VARCHAR(255) NOT NULL, ADD discount_percentage VARCHAR(255) NOT NULL, ADD star_date DATE NOT NULL, DROP product_id, DROP discount_rate');
        $this->addSql('ALTER TABLE product DROP product_date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voucher DROP FOREIGN KEY FK_1392A5D84584665A');
        $this->addSql('DROP TABLE used_voucher');
        $this->addSql('DROP TABLE voucher');
        $this->addSql('ALTER TABLE discount ADD product_id INT NOT NULL, ADD discount_rate INT NOT NULL, DROP discount_code, DROP discount_percentage, DROP star_date');
        $this->addSql('CREATE INDEX abc ON discount (product_id)');
        $this->addSql('ALTER TABLE product ADD product_date DATE DEFAULT NULL');
    }
}
