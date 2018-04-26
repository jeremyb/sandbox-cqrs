<?php

declare(strict_types=1);

namespace SandboxCQRS\Infrastructure\Persistence\Doctrine;

use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use SandboxCQRS\Domain\ReadModel\Bookmark;
use SandboxCQRS\Domain\ReadModel\BookmarkFinder;

final class DbalBookmarkFinder implements BookmarkFinder
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll() : \Traversable
    {
        $query = $this->connection->query('SELECT * FROM bookmarks');

        while ($row = $query->fetch(FetchMode::ASSOCIATIVE)) {
            yield new Bookmark(
                $row['id'],
                $row['url'],
                $row['title'],
                !empty($row['popular_words']) ? json_decode($row['popular_words'], true) : [],
                $row['image'] ?? null,
                $row['content_body'] ?? null,
                new \DateTimeImmutable($row['created_at'])
            );
        }
    }
}
