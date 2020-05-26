<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526105004 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE room_date (id INT AUTO_INCREMENT NOT NULL, room_id_id INT DEFAULT NULL, date DATE DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, discount DOUBLE PRECISION DEFAULT NULL, room_count INT DEFAULT NULL, room_booked INT DEFAULT NULL, INDEX IDX_C99ADD1E35F83FFC (room_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room2 (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, type INT DEFAULT NULL, status INT DEFAULT NULL, featured INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_date ADD CONSTRAINT FK_C99ADD1E35F83FFC FOREIGN KEY (room_id_id) REFERENCES room2 (id)');
        $this->addSql('DROP TABLE tags');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room_date DROP FOREIGN KEY FK_C99ADD1E35F83FFC');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE room_date');
        $this->addSql('DROP TABLE room2');
    }
}
