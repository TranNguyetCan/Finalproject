<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240816081927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939828AA1B6F');
        $this->addSql('DROP INDEX IDX_F529939828AA1B6F ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE voucher_id vouchers_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993983A546BF7 FOREIGN KEY (vouchers_id) REFERENCES voucher (id)');
        $this->addSql('CREATE INDEX IDX_F52993983A546BF7 ON `order` (vouchers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993983A546BF7');
        $this->addSql('DROP INDEX IDX_F52993983A546BF7 ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE vouchers_id voucher_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939828AA1B6F FOREIGN KEY (voucher_id) REFERENCES voucher (id)');
        $this->addSql('CREATE INDEX IDX_F529939828AA1B6F ON `order` (voucher_id)');
    }
}
