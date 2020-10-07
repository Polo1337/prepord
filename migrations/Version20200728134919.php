<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728134919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE player ADD essais INT DEFAULT NULL, ADD transformations INT DEFAULT NULL, ADD penalites INT DEFAULT NULL, ADD drops INT DEFAULT NULL, ADD rouges INT DEFAULT NULL, ADD jaunes INT DEFAULT NULL, ADD temps TIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE player DROP essais, DROP transformations, DROP penalites, DROP drops, DROP rouges, DROP jaunes, DROP temps');
    }
}
