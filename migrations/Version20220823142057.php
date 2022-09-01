<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823142057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces ADD livreur_id INT DEFAULT NULL, CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FF8646701 FOREIGN KEY (livreur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CB988C6FF8646701 ON annonces (livreur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FF8646701');
        $this->addSql('DROP INDEX IDX_CB988C6FF8646701 ON annonces');
        $this->addSql('ALTER TABLE annonces DROP livreur_id, CHANGE status status TINYINT(1) NOT NULL');
    }
}
