<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220908122324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE distance (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, is_active TINYINT(1) NOT NULL, coef INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD distance_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F13192463 FOREIGN KEY (distance_id) REFERENCES distance (id)');
        $this->addSql('CREATE INDEX IDX_CB988C6F13192463 ON annonces (distance_id)');
        $this->addSql('ALTER TABLE poids ADD coef INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taille ADD coef INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F13192463');
        $this->addSql('DROP TABLE distance');
        $this->addSql('DROP INDEX IDX_CB988C6F13192463 ON annonces');
        $this->addSql('ALTER TABLE annonces ADD distance VARCHAR(255) NOT NULL, DROP distance_id');
        $this->addSql('ALTER TABLE poids DROP coef');
        $this->addSql('ALTER TABLE taille DROP coef');
    }
}
