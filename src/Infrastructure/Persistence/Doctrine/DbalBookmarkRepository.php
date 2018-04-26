<?php

declare(strict_types=1);

namespace SandboxCQRS\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Types\Type;
use SandboxCQRS\Domain\Model\Bookmark;
use SandboxCQRS\Domain\Model\BookmarkRepository;

final class DbalBookmarkRepository implements BookmarkRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function add(Bookmark $bookmark) : void
    {
        $this->connection->insert(
            'bookmarks',
            [
                'id' => (string) $bookmark->getId(),
                'url' => $bookmark->getUrl()->url(),
                'domain' => $bookmark->getUrl()->domain(),
                'title' => $bookmark->getMetadata()->title(),
                'meta_description' => $bookmark->getMetadata()->metaDescription(),
                'meta_keywords' => $bookmark->getMetadata()->metaKeywords(),
                'tags' => $bookmark->getMetadata()->tags(),
                'popular_words' => $bookmark->getMetadata()->popularWords(),
                'image' => null !== $bookmark->getImage()
                    ? $bookmark->getImage()->value()
                    : null,
                'content_body' => $bookmark->getContent()->body(),
                'content_html' => $bookmark->getContent()->html(),
                'created_at' => $bookmark->getCreatedAt(),
            ],
            [
                ParameterType::STRING,
                ParameterType::STRING,
                ParameterType::STRING,
                ParameterType::STRING,
                ParameterType::STRING,
                ParameterType::STRING,
                Type::JSON,
                Type::JSON,
                ParameterType::STRING,
                ParameterType::STRING,
                ParameterType::STRING,
                Type::DATETIME,
            ]
        );
    }
}
