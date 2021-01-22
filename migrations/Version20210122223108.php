<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210122223108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates comment table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE comment (
                id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                product_id INTEGER NOT NULL,
                author VARCHAR(255) NOT NULL,
                content VARCHAR(255) NOT NULL
            )
        ');
        $this->addSql('CREATE INDEX IDX_9474526C4584665A ON comment (product_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE comment');
    }
}
