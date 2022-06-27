<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412153243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD cp VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, DROP cp_ville, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD cp_ville VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP cp, DROP ville, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE entreprise entreprise VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(30) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE note_perso note_perso VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contrat CHANGE mission mission LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE noteperso noteperso LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE secteur CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
