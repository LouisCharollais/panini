<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024162215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panini ADD COLUMN nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__panini AS SELECT id, album_id, description FROM panini');
        $this->addSql('DROP TABLE panini');
        $this->addSql('CREATE TABLE panini (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, album_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL, CONSTRAINT FK_4D5D1DD51137ABCF FOREIGN KEY (album_id) REFERENCES album (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO panini (id, album_id, description) SELECT id, album_id, description FROM __temp__panini');
        $this->addSql('DROP TABLE __temp__panini');
        $this->addSql('CREATE INDEX IDX_4D5D1DD51137ABCF ON panini (album_id)');
    }
}
