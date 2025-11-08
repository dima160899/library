<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251108183935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added Book and ReadingProgress to DB';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE book (id UUID NOT NULL, name VARCHAR(255) NOT NULL, author VARCHAR(255) DEFAULT NULL, year_of_publishing INT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN book.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE reading_progress (id UUID NOT NULL, book_id UUID NOT NULL, percent INT NOT NULL, current_page INT DEFAULT NULL, count_of_pages INT DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_74F6AFF616A2B381 ON reading_progress (book_id)');
        $this->addSql('COMMENT ON COLUMN reading_progress.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reading_progress.book_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reading_progress.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reading_progress ADD CONSTRAINT FK_74F6AFF616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE reading_progress DROP CONSTRAINT FK_74F6AFF616A2B381');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE reading_progress');
    }
}
