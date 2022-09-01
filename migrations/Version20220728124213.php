<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728124213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, poids_id INT NOT NULL, categorie_id INT NOT NULL, taille_id INT NOT NULL, expediteur VARCHAR(255) NOT NULL, destinataire VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_livraison DATETIME NOT NULL, heure_livraison DATETIME NOT NULL, distance VARCHAR(255) NOT NULL, remuneration_livreur VARCHAR(255) NOT NULL, commentaire LONGTEXT NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_CB988C6F174FEEBA (poids_id), INDEX IDX_CB988C6FBCF5E72D (categorie_id), INDEX IDX_CB988C6FFF25611A (taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonces_mode_transport (annonces_id INT NOT NULL, mode_transport_id INT NOT NULL, INDEX IDX_D6485164C2885D7 (annonces_id), INDEX IDX_D6485161305CBCC (mode_transport_id), PRIMARY KEY(annonces_id, mode_transport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, priorite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_transport (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, impact_carbone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poids (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, decription VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F174FEEBA FOREIGN KEY (poids_id) REFERENCES poids (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FFF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE annonces_mode_transport ADD CONSTRAINT FK_D6485164C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonces_mode_transport ADD CONSTRAINT FK_D6485161305CBCC FOREIGN KEY (mode_transport_id) REFERENCES mode_transport (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces_mode_transport DROP FOREIGN KEY FK_D6485164C2885D7');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FBCF5E72D');
        $this->addSql('ALTER TABLE annonces_mode_transport DROP FOREIGN KEY FK_D6485161305CBCC');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F174FEEBA');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FFF25611A');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE annonces_mode_transport');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE mode_transport');
        $this->addSql('DROP TABLE poids');
        $this->addSql('DROP TABLE taille');
    }
}
