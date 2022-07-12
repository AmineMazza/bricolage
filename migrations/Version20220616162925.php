<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616162925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_service ADD id_service_id INT DEFAULT NULL, ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sous_service ADD CONSTRAINT FK_C294E29F48D62931 FOREIGN KEY (id_service_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_C294E29F48D62931 ON sous_service (id_service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_service DROP FOREIGN KEY FK_C294E29F48D62931');
        $this->addSql('DROP INDEX IDX_C294E29F48D62931 ON sous_service');
        $this->addSql('ALTER TABLE sous_service DROP id_service_id, DROP description');
    }
}
