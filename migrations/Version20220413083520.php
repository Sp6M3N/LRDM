<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413083520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, event_post_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526CCEDEAA83 (event_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_type_id INT DEFAULT NULL, created_at DATETIME NOT NULL, event_date DATETIME NOT NULL, title VARCHAR(255) NOT NULL, detail LONGTEXT NOT NULL, INDEX IDX_3BAE0AA7401B253C (event_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_image (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_8426B57371F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_post (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_4541202671F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_post_image (id INT AUTO_INCREMENT NOT NULL, event_post_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_AC8519FCEDEAA83 (event_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_reservation (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, created_at DATETIME NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, tel INT DEFAULT NULL, quantity INT NOT NULL, paid TINYINT(1) NOT NULL, INDEX IDX_E9419AD571F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_type (id INT AUTO_INCREMENT NOT NULL, wording VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE new_letter (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCEDEAA83 FOREIGN KEY (event_post_id) REFERENCES event_post (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
        $this->addSql('ALTER TABLE event_image ADD CONSTRAINT FK_8426B57371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_post ADD CONSTRAINT FK_4541202671F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_post_image ADD CONSTRAINT FK_AC8519FCEDEAA83 FOREIGN KEY (event_post_id) REFERENCES event_post (id)');
        $this->addSql('ALTER TABLE event_reservation ADD CONSTRAINT FK_E9419AD571F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_image DROP FOREIGN KEY FK_8426B57371F7E88B');
        $this->addSql('ALTER TABLE event_post DROP FOREIGN KEY FK_4541202671F7E88B');
        $this->addSql('ALTER TABLE event_reservation DROP FOREIGN KEY FK_E9419AD571F7E88B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCEDEAA83');
        $this->addSql('ALTER TABLE event_post_image DROP FOREIGN KEY FK_AC8519FCEDEAA83');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7401B253C');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_image');
        $this->addSql('DROP TABLE event_post');
        $this->addSql('DROP TABLE event_post_image');
        $this->addSql('DROP TABLE event_reservation');
        $this->addSql('DROP TABLE event_type');
        $this->addSql('DROP TABLE new_letter');
        $this->addSql('DROP TABLE user');
    }
}
