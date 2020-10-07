<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200722124157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, picture VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, match_type_id INT NOT NULL, date DATETIME NOT NULL, duration TIME DEFAULT NULL, local_team VARCHAR(500) DEFAULT NULL, visitor_team VARCHAR(500) DEFAULT NULL, stats JSON DEFAULT NULL, composition JSON DEFAULT NULL, INDEX IDX_7A5BC505B2EAD3FC (match_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE match_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, lest_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, picture VARCHAR(500) DEFAULT NULL, birth_date DATE DEFAULT NULL, club_entry_date DATE DEFAULT NULL, stats JSON DEFAULT NULL, license_number INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE player_team (player_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_66FAF62C99E6F5DF (player_id), INDEX IDX_66FAF62C296CD8AE (team_id), PRIMARY KEY(player_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE player_post (player_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_F8903CBE99E6F5DF (player_id), INDEX IDX_F8903CBE4B89032C (post_id), PRIMARY KEY(player_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, post VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, season_start DATE DEFAULT NULL, season_end DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, play_season_id INT DEFAULT NULL, category VARCHAR(500) NOT NULL, INDEX IDX_C4E0A61F79D32D8C (play_season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE team_match (team_id INT NOT NULL, match_id INT NOT NULL, INDEX IDX_BD5D8C45296CD8AE (team_id), INDEX IDX_BD5D8C452ABEACD6 (match_id), PRIMARY KEY(team_id, match_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE user_team (user_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_BE61EAD6A76ED395 (user_id), INDEX IDX_BE61EAD6296CD8AE (team_id), PRIMARY KEY(user_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505B2EAD3FC FOREIGN KEY (match_type_id) REFERENCES match_type (id)');
        // $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE player_team ADD CONSTRAINT FK_66FAF62C296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE player_post ADD CONSTRAINT FK_F8903CBE99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE player_post ADD CONSTRAINT FK_F8903CBE4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F79D32D8C FOREIGN KEY (play_season_id) REFERENCES season (id)');
        // $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C45296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C452ABEACD6 FOREIGN KEY (match_id) REFERENCES `match` (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE user_team ADD CONSTRAINT FK_BE61EAD6296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE user ADD finances_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499245991F FOREIGN KEY (finances_id) REFERENCES club (id)');
        // $this->addSql('CREATE INDEX IDX_8D93D6499245991F ON user (finances_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499245991F');
        // $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C452ABEACD6');
        // $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505B2EAD3FC');
        // $this->addSql('ALTER TABLE player_team DROP FOREIGN KEY FK_66FAF62C99E6F5DF');
        // $this->addSql('ALTER TABLE player_post DROP FOREIGN KEY FK_F8903CBE99E6F5DF');
        // $this->addSql('ALTER TABLE player_post DROP FOREIGN KEY FK_F8903CBE4B89032C');
        // $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F79D32D8C');
        // $this->addSql('ALTER TABLE player_team DROP FOREIGN KEY FK_66FAF62C296CD8AE');
        // $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C45296CD8AE');
        // $this->addSql('ALTER TABLE user_team DROP FOREIGN KEY FK_BE61EAD6296CD8AE');
        // $this->addSql('DROP TABLE club');
        // $this->addSql('DROP TABLE `match`');
        // $this->addSql('DROP TABLE match_type');
        // $this->addSql('DROP TABLE player');
        // $this->addSql('DROP TABLE player_team');
        // $this->addSql('DROP TABLE player_post');
        // $this->addSql('DROP TABLE post');
        // $this->addSql('DROP TABLE season');
        // $this->addSql('DROP TABLE team');
        // $this->addSql('DROP TABLE team_match');
        // $this->addSql('DROP TABLE user_team');
        // $this->addSql('DROP INDEX IDX_8D93D6499245991F ON user');
        // $this->addSql('ALTER TABLE user DROP finances_id');
    }
}
