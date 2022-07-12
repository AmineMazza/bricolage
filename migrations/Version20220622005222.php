<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220622005222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command ADD id_sous_service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD448D62931 FOREIGN KEY (id_service_id) REFERENCES services (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4E27A3F84 FOREIGN KEY (id_sous_service_id) REFERENCES sous_services (id)');
        $this->addSql('CREATE INDEX IDX_8ECAEAD448D62931 ON command (id_service_id)');
        $this->addSql('CREATE INDEX IDX_8ECAEAD4E27A3F84 ON command (id_sous_service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD448D62931');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4E27A3F84');
        $this->addSql('DROP INDEX IDX_8ECAEAD448D62931 ON command');
        $this->addSql('DROP INDEX IDX_8ECAEAD4E27A3F84 ON command');
        $this->addSql('ALTER TABLE command DROP id_sous_service_id');
    }
}
