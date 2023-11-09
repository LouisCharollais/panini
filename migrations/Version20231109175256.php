<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109175256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__equipe AS SELECT id, nom FROM equipe');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('CREATE TABLE equipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, createur_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_2449BA1573A201E5 FOREIGN KEY (createur_id) REFERENCES equipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO equipe (id, nom) SELECT id, nom FROM __temp__equipe');
        $this->addSql('DROP TABLE __temp__equipe');
        $this->addSql('CREATE INDEX IDX_2449BA1573A201E5 ON equipe (createur_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__membre AS SELECT id, nom, prenom FROM membre');
        $this->addSql('DROP TABLE membre');
        $this->addSql('CREATE TABLE membre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO membre (id, nom, prenom) SELECT id, nom, prenom FROM __temp__membre');
        $this->addSql('DROP TABLE __temp__membre');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__equipe AS SELECT id, nom FROM equipe');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('CREATE TABLE equipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO equipe (id, nom) SELECT id, nom FROM __temp__equipe');
        $this->addSql('DROP TABLE __temp__equipe');
        $this->addSql('CREATE TEMPORARY TABLE __temp__membre AS SELECT id, nom, prenom FROM membre');
        $this->addSql('DROP TABLE membre');
        $this->addSql('CREATE TABLE membre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, equipes_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, CONSTRAINT FK_F6B4FB29737800BA FOREIGN KEY (equipes_id) REFERENCES equipe (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO membre (id, nom, prenom) SELECT id, nom, prenom FROM __temp__membre');
        $this->addSql('DROP TABLE __temp__membre');
        $this->addSql('CREATE INDEX IDX_F6B4FB29737800BA ON membre (equipes_id)');
    }
}
