<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003210211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album ADD COLUMN nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__album AS SELECT id, membres_id FROM album');
        $this->addSql('DROP TABLE album');
        $this->addSql('CREATE TABLE album (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, membres_id INTEGER NOT NULL, CONSTRAINT FK_39986E4371128C5C FOREIGN KEY (membres_id) REFERENCES membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO album (id, membres_id) SELECT id, membres_id FROM __temp__album');
        $this->addSql('DROP TABLE __temp__album');
        $this->addSql('CREATE INDEX IDX_39986E4371128C5C ON album (membres_id)');
    }
}
