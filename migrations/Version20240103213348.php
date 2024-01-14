<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103213348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE educateurs (id INT AUTO_INCREMENT NOT NULL, licencies_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, is_admin INT NOT NULL, INDEX IDX_CE18B2EEB0AC65CD (licencies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE educateurs ADD CONSTRAINT FK_CE18B2EEB0AC65CD FOREIGN KEY (licencies_id) REFERENCES licencies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE educateurs DROP FOREIGN KEY FK_CE18B2EEB0AC65CD');
        $this->addSql('DROP TABLE educateurs');
    }
}
