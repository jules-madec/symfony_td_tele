<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313104701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, salle VARCHAR(255) NOT NULL, intervenant VARCHAR(255) NOT NULL, promo_id INT NOT NULL, INDEX IDX_3BAE0AA7D0C07AFF (promo_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7D0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7D0C07AFF');
        $this->addSql('DROP TABLE event');
    }
}
