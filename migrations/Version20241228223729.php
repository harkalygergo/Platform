<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241228223729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add default ROLE_ADMIN to roles JSON column';
    }

    public function up(Schema $schema): void
    {
        // Add your SQL here
        $this->addSql('
            CREATE TRIGGER set_default_role_empty
            BEFORE INSERT ON user
            FOR EACH ROW
            BEGIN
                IF NEW.roles IS NULL THEN
                    SET NEW.roles = \'[]\';
                END IF;
            END;
        ');
    }

    public function down(Schema $schema): void
    {
        // Drop the trigger if you need to rollback the migration
        $this->addSql('DROP TRIGGER IF EXISTS set_default_role_empty');
    }
}
