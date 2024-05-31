<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528185706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE used_voucher DROP FOREIGN KEY edf');
        $this->addSql('ALTER TABLE used_voucher DROP FOREIGN KEY bcd');
        $this->addSql('DROP TABLE used_voucher');
        $this->addSql('DROP TABLE voucher');
        $this->addSql('ALTER TABLE discount DROP FOREIGN KEY abc');
        $this->addSql('ALTER TABLE discount DROP FOREIGN KEY abc');
        $this->addSql('ALTER TABLE discount ADD start_date DATETIME NOT NULL, ADD description VARCHAR(255) DEFAULT NULL, CHANGE end_date end_date DATETIME NOT NULL, CHANGE discount_rate deal INT NOT NULL');
        $this->addSql('ALTER TABLE discount ADD CONSTRAINT FK_E1E0B40E4584665A FOREIGN KEY (product_id) REFERENCES pro_size (id)');
        $this->addSql('DROP INDEX abc ON discount');
        $this->addSql('CREATE INDEX IDX_E1E0B40E4584665A ON discount (product_id)');
        $this->addSql('ALTER TABLE discount ADD CONSTRAINT abc FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD original_price VARCHAR(255) DEFAULT NULL, DROP product_date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE used_voucher (id INT AUTO_INCREMENT NOT NULL, voucher_id INT NOT NULL, user_id INT NOT NULL, use_date INT NOT NULL, INDEX edf (voucher_id), INDEX bcd (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voucher (id INT AUTO_INCREMENT NOT NULL, deal VARCHAR(11) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, discount_rate INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE used_voucher ADD CONSTRAINT edf FOREIGN KEY (voucher_id) REFERENCES voucher (id)');
        $this->addSql('ALTER TABLE used_voucher ADD CONSTRAINT bcd FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE discount DROP FOREIGN KEY FK_E1E0B40E4584665A');
        $this->addSql('ALTER TABLE discount DROP FOREIGN KEY FK_E1E0B40E4584665A');
        $this->addSql('ALTER TABLE discount DROP start_date, DROP description, CHANGE end_date end_date DATE NOT NULL, CHANGE deal discount_rate INT NOT NULL');
        $this->addSql('ALTER TABLE discount ADD CONSTRAINT abc FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('DROP INDEX idx_e1e0b40e4584665a ON discount');
        $this->addSql('CREATE INDEX abc ON discount (product_id)');
        $this->addSql('ALTER TABLE discount ADD CONSTRAINT FK_E1E0B40E4584665A FOREIGN KEY (product_id) REFERENCES pro_size (id)');
        $this->addSql('ALTER TABLE product ADD product_date DATE DEFAULT NULL, DROP original_price');
    }
}
