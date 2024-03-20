<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227094147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F466C8A81A9');
        $this->addSql('DROP INDEX IDX_ED896F466C8A81A9 ON order_detail');
        $this->addSql('ALTER TABLE order_detail ADD pro_size_id INT DEFAULT NULL, DROP products_id');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46BC246EFC FOREIGN KEY (pro_size_id) REFERENCES pro_size (id)');
        $this->addSql('CREATE INDEX IDX_ED896F46BC246EFC ON order_detail (pro_size_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46BC246EFC');
        $this->addSql('DROP INDEX IDX_ED896F46BC246EFC ON order_detail');
        $this->addSql('ALTER TABLE order_detail ADD products_id INT NOT NULL, DROP pro_size_id');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F466C8A81A9 FOREIGN KEY (products_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_ED896F466C8A81A9 ON order_detail (products_id)');
    }
}
