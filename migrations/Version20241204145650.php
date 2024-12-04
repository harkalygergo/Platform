<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204145650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instance (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, owner INT DEFAULT NULL, intranet LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instance_user (instance_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A59986823A51721D (instance_id), INDEX IDX_A5998682A76ED395 (user_id), PRIMARY KEY(instance_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name_prefix VARCHAR(8) DEFAULT NULL, first_name VARCHAR(64) DEFAULT NULL, middle_name VARCHAR(32) DEFAULT NULL, last_name VARCHAR(64) DEFAULT NULL, nick_name VARCHAR(128) DEFAULT NULL, password VARCHAR(255) NOT NULL, birth_name VARCHAR(128) DEFAULT NULL, phone VARCHAR(32) DEFAULT NULL, email VARCHAR(128) DEFAULT NULL, status TINYINT(1) NOT NULL, last_login DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_activation DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', profile_image_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instance_user ADD CONSTRAINT FK_A59986823A51721D FOREIGN KEY (instance_id) REFERENCES instance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instance_user ADD CONSTRAINT FK_A5998682A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instance_user DROP FOREIGN KEY FK_A59986823A51721D');
        $this->addSql('ALTER TABLE instance_user DROP FOREIGN KEY FK_A5998682A76ED395');
        $this->addSql('DROP TABLE instance');
        $this->addSql('DROP TABLE instance_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
