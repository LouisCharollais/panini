<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109175529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membre_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_39986E436A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_39986E436A99F74A ON album (membre_id)');
        $this->addSql('CREATE TABLE equipe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, createur_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_2449BA1573A201E5 FOREIGN KEY (createur_id) REFERENCES equipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2449BA1573A201E5 ON equipe (createur_id)');
        $this->addSql('CREATE TABLE equipe_panini (equipe_id INTEGER NOT NULL, panini_id INTEGER NOT NULL, PRIMARY KEY(equipe_id, panini_id), CONSTRAINT FK_406A7B7D6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_406A7B7D7B573F3 FOREIGN KEY (panini_id) REFERENCES panini (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_406A7B7D6D861B89 ON equipe_panini (equipe_id)');
        $this->addSql('CREATE INDEX IDX_406A7B7D7B573F3 ON equipe_panini (panini_id)');
        $this->addSql('CREATE TABLE membre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE panini (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, album_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, CONSTRAINT FK_4D5D1DD51137ABCF FOREIGN KEY (album_id) REFERENCES album (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_4D5D1DD51137ABCF ON panini (album_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE equipe_panini');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE panini');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
