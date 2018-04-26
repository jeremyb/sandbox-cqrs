<?php

declare(strict_types=1);

namespace SandboxCQRS\Domain\Model;

use DateTimeImmutable;

final class Bookmark
{
    private $id;
    private $url;
    private $metadata;
    private $image;
    private $content;
    private $createdAt;

    public function __construct(
        BookmarkId $id,
        Url $url,
        Metadata $metadata,
        ?Image $image,
        Content $content
    ) {
        $this->id = $id;
        $this->url = $url;
        $this->metadata = $metadata;
        $this->image = $image;
        $this->content = $content;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId() : BookmarkId
    {
        return $this->id;
    }

    public function getUrl() : Url
    {
        return $this->url;
    }

    public function getMetadata() : Metadata
    {
        return $this->metadata;
    }

    public function getImage() : ?Image
    {
        return $this->image;
    }

    public function getContent() : Content
    {
        return $this->content;
    }

    public function getCreatedAt() : DateTimeImmutable
    {
        return $this->createdAt;
    }
}
