<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617102436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services ADD id_catégorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169C406963F FOREIGN KEY (id_catégorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_7332E169C406963F ON services (id_catégorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E169C406963F');
        $this->addSql('DROP INDEX IDX_7332E169C406963F ON services');
        $this->addSql('ALTER TABLE services DROP id_catégorie_id');
    }
}
