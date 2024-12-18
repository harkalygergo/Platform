<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241218150836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instance_billing_profile (instance_id INT NOT NULL, billing_profile_id INT NOT NULL, INDEX IDX_6E58FFD93A51721D (instance_id), INDEX IDX_6E58FFD9409D7D29 (billing_profile_id), PRIMARY KEY(instance_id, billing_profile_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instance_billing_profile ADD CONSTRAINT FK_6E58FFD93A51721D FOREIGN KEY (instance_id) REFERENCES instance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instance_billing_profile ADD CONSTRAINT FK_6E58FFD9409D7D29 FOREIGN KEY (billing_profile_id) REFERENCES billing_profile (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instance_billing_profile DROP FOREIGN KEY FK_6E58FFD93A51721D');
        $this->addSql('ALTER TABLE instance_billing_profile DROP FOREIGN KEY FK_6E58FFD9409D7D29');
        $this->addSql('DROP TABLE instance_billing_profile');
    }
}
