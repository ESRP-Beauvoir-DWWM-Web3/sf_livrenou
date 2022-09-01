<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220822133111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces ADD expediteur_id INT NOT NULL, DROP expediteur');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F10335F61 FOREIGN KEY (expediteur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CB988C6F10335F61 ON annonces (expediteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F10335F61');
        $this->addSql('DROP INDEX IDX_CB988C6F10335F61 ON annonces');
        $this->addSql('ALTER TABLE annonces ADD expediteur VARCHAR(255) NOT NULL, DROP expediteur_id');
    }
}
