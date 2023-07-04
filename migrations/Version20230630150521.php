<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230630150521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sous_tache (id INT AUTO_INCREMENT NOT NULL, tache_id INT NOT NULL, titre VARCHAR(50) NOT NULL, INDEX IDX_EC632090D2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sous_tache ADD CONSTRAINT FK_EC632090D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_tache DROP FOREIGN KEY FK_EC632090D2235D39');
        $this->addSql('DROP TABLE sous_tache');
    }
}
