<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617003813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_services ADD id_service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sous_services ADD CONSTRAINT FK_7B7CD53C48D62931 FOREIGN KEY (id_service_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_7B7CD53C48D62931 ON sous_services (id_service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_services DROP FOREIGN KEY FK_7B7CD53C48D62931');
        $this->addSql('DROP INDEX IDX_7B7CD53C48D62931 ON sous_services');
        $this->addSql('ALTER TABLE sous_services DROP id_service_id');
    }
}
