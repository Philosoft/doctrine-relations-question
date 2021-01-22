<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210122222035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates product table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE product (
                id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                slug VARCHAR(255) NOT NULL,name VARCHAR(255) NOT NULL
            )
        ');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD989D9B62 ON product (slug)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product');
    }
}
