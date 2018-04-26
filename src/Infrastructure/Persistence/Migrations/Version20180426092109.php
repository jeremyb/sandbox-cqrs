<?php

declare(strict_types = 1);

namespace SandboxCQRS\Infrastructure\Persistence\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180426092109 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $bookmarks = $schema->createTable('bookmarks');
        $bookmarks->addColumn('id', 'string');
        $bookmarks->setPrimaryKey(['id']);
        $bookmarks->addColumn('url', 'string');
        $bookmarks->addColumn('domain', 'string', ['notnull' => false]);
        $bookmarks->addColumn('title', 'string');
        $bookmarks->addColumn('meta_description', 'text', ['notnull' => false]);
        $bookmarks->addColumn('meta_keywords', 'text', ['notnull' => false]);
        $bookmarks->addColumn('tags', 'json', ['notnull' => false]);
        $bookmarks->addColumn('popular_words', 'json', ['notnull' => false]);
        $bookmarks->addColumn('image', 'string', ['notnull' => false]);
        $bookmarks->addColumn('content_body', 'text', ['notnull' => false]);
        $bookmarks->addColumn('content_html', 'text', ['notnull' => false]);
        $bookmarks->addColumn('created_at', 'datetime');
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('bookmarks');
    }
}
