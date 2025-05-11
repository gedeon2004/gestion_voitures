<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250510231633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id SERIAL NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, telephone VARCHAR(20) NOT NULL, adresse TEXT DEFAULT NULL, cni VARCHAR(30) NOT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_C7440455E7927C74 ON client (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_C74404557AC033BE ON client (cni)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ALTER prix_actuel TYPE NUMERIC(10, 2)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ALTER prix_actuel DROP DEFAULT
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ALTER is_published DROP DEFAULT
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE client
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ALTER prix_actuel TYPE DOUBLE PRECISION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ALTER prix_actuel SET DEFAULT '0'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ALTER is_published SET DEFAULT false
        SQL);
    }
}
