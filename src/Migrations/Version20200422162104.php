<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422162104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bagages (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, code_bagage VARCHAR(255) DEFAULT NULL, poids VARCHAR(255) DEFAULT NULL, liste_bagages LONGTEXT DEFAULT NULL, INDEX IDX_767B07B7B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nomcli VARCHAR(255) DEFAULT NULL, prenomcli VARCHAR(255) DEFAULT NULL, telcli VARCHAR(255) DEFAULT NULL, emailcli VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnie_aeriennes (id INT AUTO_INCREMENT NOT NULL, nom_compagnie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, vol_id INT DEFAULT NULL, client_id INT DEFAULT NULL, INDEX IDX_4DA2399F2BFB7A (vol_id), INDEX IDX_4DA23919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vols (id INT AUTO_INCREMENT NOT NULL, compagnie_id INT DEFAULT NULL, date_depart DATE DEFAULT NULL, heure_depart TIME DEFAULT NULL, date_arrivee DATE DEFAULT NULL, heure_arrivee TIME DEFAULT NULL, aeroport_depart VARCHAR(255) DEFAULT NULL, aeroport_arrivee VARCHAR(255) DEFAULT NULL, INDEX IDX_2CDFA86C52FBE437 (compagnie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bagages ADD CONSTRAINT FK_767B07B7B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2399F2BFB7A FOREIGN KEY (vol_id) REFERENCES vols (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE vols ADD CONSTRAINT FK_2CDFA86C52FBE437 FOREIGN KEY (compagnie_id) REFERENCES compagnie_aeriennes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921');
        $this->addSql('ALTER TABLE vols DROP FOREIGN KEY FK_2CDFA86C52FBE437');
        $this->addSql('ALTER TABLE bagages DROP FOREIGN KEY FK_767B07B7B83297E7');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2399F2BFB7A');
        $this->addSql('DROP TABLE bagages');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE compagnie_aeriennes');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE vols');
    }
}
