<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231017105719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE canciones ADD artista_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE canciones ADD CONSTRAINT FK_AEE7E881AEB0CF13 FOREIGN KEY (artista_id) REFERENCES artista (id)');
        $this->addSql('CREATE INDEX IDX_AEE7E881AEB0CF13 ON canciones (artista_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE canciones DROP FOREIGN KEY FK_AEE7E881AEB0CF13');
        $this->addSql('DROP INDEX IDX_AEE7E881AEB0CF13 ON canciones');
        $this->addSql('ALTER TABLE canciones DROP artista_id');
    }
}
