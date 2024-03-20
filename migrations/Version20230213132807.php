<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213132807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pro_size (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, size_id INT DEFAULT NULL, INDEX IDX_27E091184584665A (product_id), INDEX IDX_27E09118498DA827 (size_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pro_size ADD CONSTRAINT FK_27E091184584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE pro_size ADD CONSTRAINT FK_27E09118498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro_size DROP FOREIGN KEY FK_27E091184584665A');
        $this->addSql('ALTER TABLE pro_size DROP FOREIGN KEY FK_27E09118498DA827');
        $this->addSql('DROP TABLE pro_size');
    }
}
