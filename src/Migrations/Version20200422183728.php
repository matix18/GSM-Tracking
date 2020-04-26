<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422183728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bagages CHANGE reservation_id reservation_id INT DEFAULT NULL, CHANGE code_bagage code_bagage VARCHAR(255) DEFAULT NULL, CHANGE poids poids VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE clients CHANGE nomcli nomcli VARCHAR(255) DEFAULT NULL, CHANGE prenomcli prenomcli VARCHAR(255) DEFAULT NULL, CHANGE telcli telcli VARCHAR(255) DEFAULT NULL, CHANGE emailcli emailcli VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE compagnie_aeriennes CHANGE nom_compagnie nom_compagnie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE employes CHANGE email email VARCHAR(180) NOT NULL, CHANGE username username VARCHAR(255) DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A94BC0F0E7927C74 ON employes (email)');
        $this->addSql('ALTER TABLE reservations ADD created_at DATETIME DEFAULT NULL, CHANGE vol_id vol_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vols CHANGE compagnie_id compagnie_id INT DEFAULT NULL, CHANGE date_depart date_depart DATE DEFAULT NULL, CHANGE heure_depart heure_depart TIME DEFAULT NULL, CHANGE date_arrivee date_arrivee DATE DEFAULT NULL, CHANGE heure_arrivee heure_arrivee TIME DEFAULT NULL, CHANGE aeroport_depart aeroport_depart VARCHAR(255) DEFAULT NULL, CHANGE aeroport_arrivee aeroport_arrivee VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bagages CHANGE reservation_id reservation_id INT DEFAULT NULL, CHANGE code_bagage code_bagage VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE poids poids VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE clients CHANGE nomcli nomcli VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE prenomcli prenomcli VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telcli telcli VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE emailcli emailcli VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE compagnie_aeriennes CHANGE nom_compagnie nom_compagnie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_A94BC0F0E7927C74 ON employes');
        $this->addSql('ALTER TABLE employes CHANGE email email VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE password password VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE username username VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reservations DROP created_at, CHANGE vol_id vol_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vols CHANGE compagnie_id compagnie_id INT DEFAULT NULL, CHANGE date_depart date_depart DATE DEFAULT \'NULL\', CHANGE heure_depart heure_depart TIME DEFAULT \'NULL\', CHANGE date_arrivee date_arrivee DATE DEFAULT \'NULL\', CHANGE heure_arrivee heure_arrivee TIME DEFAULT \'NULL\', CHANGE aeroport_depart aeroport_depart VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE aeroport_arrivee aeroport_arrivee VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
