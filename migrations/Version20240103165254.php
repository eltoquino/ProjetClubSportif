<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240103165254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE educateurs DROP FOREIGN KEY educateurs_ibfk_1');
        $this->addSql('DROP TABLE educateurs');
        $this->addSql('ALTER TABLE categories CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE code code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contacts CHANGE email email VARCHAR(150) NOT NULL, CHANGE numero_tel numero_tel VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE licencies DROP FOREIGN KEY licencies_ibfk_2');
        $this->addSql('ALTER TABLE licencies DROP FOREIGN KEY licencies_ibfk_1');
        $this->addSql('DROP INDEX numero_licence ON licencies');
        $this->addSql('DROP INDEX categorie_id ON licencies');
        $this->addSql('DROP INDEX contact_id ON licencies');
        $this->addSql('ALTER TABLE licencies ADD contacts_id INT DEFAULT NULL, ADD categories_id INT DEFAULT NULL, DROP contact_id, DROP categorie_id, DROP prenom');
        $this->addSql('ALTER TABLE licencies ADD CONSTRAINT FK_E88CCB15719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts (id)');
        $this->addSql('ALTER TABLE licencies ADD CONSTRAINT FK_E88CCB15A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_E88CCB15719FB48E ON licencies (contacts_id)');
        $this->addSql('CREATE INDEX IDX_E88CCB15A21214B7 ON licencies (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE educateurs (id INT NOT NULL, email VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, mot_de_passe VARCHAR(500) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE educateurs ADD CONSTRAINT educateurs_ibfk_1 FOREIGN KEY (id) REFERENCES licencies (id)');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE categories CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE code code VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE contacts CHANGE email email VARCHAR(255) NOT NULL, CHANGE numero_tel numero_tel VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE licencies DROP FOREIGN KEY FK_E88CCB15719FB48E');
        $this->addSql('ALTER TABLE licencies DROP FOREIGN KEY FK_E88CCB15A21214B7');
        $this->addSql('DROP INDEX IDX_E88CCB15719FB48E ON licencies');
        $this->addSql('DROP INDEX IDX_E88CCB15A21214B7 ON licencies');
        $this->addSql('ALTER TABLE licencies ADD contact_id INT DEFAULT NULL, ADD categorie_id INT DEFAULT NULL, ADD prenom VARCHAR(255) NOT NULL, DROP contacts_id, DROP categories_id');
        $this->addSql('ALTER TABLE licencies ADD CONSTRAINT licencies_ibfk_2 FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE licencies ADD CONSTRAINT licencies_ibfk_1 FOREIGN KEY (contact_id) REFERENCES contacts (id)');
        $this->addSql('CREATE UNIQUE INDEX numero_licence ON licencies (numero_licence)');
        $this->addSql('CREATE INDEX categorie_id ON licencies (categorie_id)');
        $this->addSql('CREATE INDEX contact_id ON licencies (contact_id)');
    }
}
