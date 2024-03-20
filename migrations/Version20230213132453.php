<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213132453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro_sup ADD product_id INT DEFAULT NULL, ADD supplier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pro_sup ADD CONSTRAINT FK_EB1876714584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE pro_sup ADD CONSTRAINT FK_EB1876712ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('CREATE INDEX IDX_EB1876714584665A ON pro_sup (product_id)');
        $this->addSql('CREATE INDEX IDX_EB1876712ADD6D8C ON pro_sup (supplier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro_sup DROP FOREIGN KEY FK_EB1876714584665A');
        $this->addSql('ALTER TABLE pro_sup DROP FOREIGN KEY FK_EB1876712ADD6D8C');
        $this->addSql('DROP INDEX IDX_EB1876714584665A ON pro_sup');
        $this->addSql('DROP INDEX IDX_EB1876712ADD6D8C ON pro_sup');
        $this->addSql('ALTER TABLE pro_sup DROP product_id, DROP supplier_id');
    }
}
