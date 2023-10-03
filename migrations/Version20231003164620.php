<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003164620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE member');
        $this->addSql('ALTER TABLE membre ADD COLUMN nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE membre ADD COLUMN prenom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE "BINARY", description VARCHAR(255) DEFAULT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TEMPORARY TABLE __temp__membre AS SELECT id FROM membre');
        $this->addSql('DROP TABLE membre');
        $this->addSql('CREATE TABLE membre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO membre (id) SELECT id FROM __temp__membre');
        $this->addSql('DROP TABLE __temp__membre');
    }
}
