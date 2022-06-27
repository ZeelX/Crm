<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620092956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, created_at DATETIME NOT NULL, finished_at DATETIME DEFAULT NULL, mission LONGTEXT NOT NULL, noteperso LONGTEXT DEFAULT NULL, INDEX IDX_6034999319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_6034999319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE contrat');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contrat_ended (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, created_at DATETIME NOT NULL, finished_at DATETIME DEFAULT NULL, mission LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, noteperso LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_ABC0BF8919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE contrat_ended ADD CONSTRAINT FK_ABC0BF8919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE contrat');
    }
}
