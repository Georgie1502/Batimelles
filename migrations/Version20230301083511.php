<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301083511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, source_id INT DEFAULT NULL, titre VARCHAR(200) NOT NULL, contenu LONGTEXT NOT NULL, date DATETIME NOT NULL, validation TINYINT(1) NOT NULL, INDEX IDX_23A0E66953C1C61 (source_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artisane (id INT AUTO_INCREMENT NOT NULL, type_utilisateur_id INT DEFAULT NULL, metier_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, telephone VARCHAR(255) NOT NULL, mail VARCHAR(200) NOT NULL, password VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, nom_entreprise VARCHAR(100) NOT NULL, anees_experience DATE NOT NULL, activation TINYINT(1) NOT NULL, horaires VARCHAR(100) NOT NULL, INDEX IDX_F03C993EAD4BC8DB (type_utilisateur_id), INDEX IDX_F03C993EED16FA20 (metier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, artisane_id INT DEFAULT NULL, nom VARCHAR(200) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_C53D045FC758408E (artisane_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_article (image_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_972A59BA3DA5256D (image_id), INDEX IDX_972A59BA7294869C (article_id), PRIMARY KEY(image_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation_artisane (prestation_id INT NOT NULL, artisane_id INT NOT NULL, INDEX IDX_792C242D9E45C554 (prestation_id), INDEX IDX_792C242DC758408E (artisane_id), PRIMARY KEY(prestation_id, artisane_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, type_utilisateur_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, mail VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_1D1C63B3AD4BC8DB (type_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE artisane ADD CONSTRAINT FK_F03C993EAD4BC8DB FOREIGN KEY (type_utilisateur_id) REFERENCES type_utilisateur (id)');
        $this->addSql('ALTER TABLE artisane ADD CONSTRAINT FK_F03C993EED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FC758408E FOREIGN KEY (artisane_id) REFERENCES artisane (id)');
        $this->addSql('ALTER TABLE image_article ADD CONSTRAINT FK_972A59BA3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_article ADD CONSTRAINT FK_972A59BA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_artisane ADD CONSTRAINT FK_792C242D9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_artisane ADD CONSTRAINT FK_792C242DC758408E FOREIGN KEY (artisane_id) REFERENCES artisane (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3AD4BC8DB FOREIGN KEY (type_utilisateur_id) REFERENCES type_utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66953C1C61');
        $this->addSql('ALTER TABLE artisane DROP FOREIGN KEY FK_F03C993EAD4BC8DB');
        $this->addSql('ALTER TABLE artisane DROP FOREIGN KEY FK_F03C993EED16FA20');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FC758408E');
        $this->addSql('ALTER TABLE image_article DROP FOREIGN KEY FK_972A59BA3DA5256D');
        $this->addSql('ALTER TABLE image_article DROP FOREIGN KEY FK_972A59BA7294869C');
        $this->addSql('ALTER TABLE prestation_artisane DROP FOREIGN KEY FK_792C242D9E45C554');
        $this->addSql('ALTER TABLE prestation_artisane DROP FOREIGN KEY FK_792C242DC758408E');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3AD4BC8DB');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE artisane');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_article');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE prestation_artisane');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE type_utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
