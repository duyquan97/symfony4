<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200511111247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, province VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, status INT DEFAULT NULL, featured INT DEFAULT NULL, price_days DOUBLE PRECISION DEFAULT NULL, price_weekend DOUBLE PRECISION DEFAULT NULL, price_holiday DOUBLE PRECISION DEFAULT NULL, discount DOUBLE PRECISION DEFAULT NULL, discount_days DOUBLE PRECISION DEFAULT NULL, discount_weekend DOUBLE PRECISION DEFAULT NULL, discount_holiday DOUBLE PRECISION DEFAULT NULL, service LONGTEXT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, room_total INT DEFAULT NULL, room_booked INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE rooms');
    }
}
