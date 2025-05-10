<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509235052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD prix_actuel DOUBLE PRECISION DEFAULT 0 NOT NULL

        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD ancien_prix NUMERIC(10, 2) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD note INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture ADD is_published BOOLEAN DEFAULT false NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP prix_actuel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP ancien_prix
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP note
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE voiture DROP is_published
        SQL);
    }
}
