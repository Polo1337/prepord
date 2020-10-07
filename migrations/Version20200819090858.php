<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819090858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE player DROP essais, DROP transformations, DROP penalites, DROP drops, DROP rouges, DROP jaunes, DROP temps');
        // $this->addSql('ALTER TABLE season CHANGE name name VARCHAR(255) DEFAULT NULL');
        // $this->addSql('ALTER TABLE team ADD picture VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE player ADD essais INT DEFAULT NULL, ADD transformations INT DEFAULT NULL, ADD penalites INT DEFAULT NULL, ADD drops INT DEFAULT NULL, ADD rouges INT DEFAULT NULL, ADD jaunes INT DEFAULT NULL, ADD temps TIME DEFAULT NULL');
        // $this->addSql('ALTER TABLE season CHANGE name name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        // $this->addSql('ALTER TABLE team DROP picture');
    }
}
