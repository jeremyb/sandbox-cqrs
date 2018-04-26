<?php

declare(strict_types=1);

namespace SandboxCQRS\Domain\ReadModel;

use DateTimeImmutable;

final class Bookmark
{
    private $id;
    private $url;
    private $title;
    private $popularWords;
    private $image;
    private $body;
    private $createdAt;

    public function __construct(
        string $id,
        string $url,
        string $title,
        array $popularWords,
        ?string $image,
        ?string $body,
        DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
        $this->popularWords = $popularWords;
        $this->image = $image;
        $this->body = $body;
        $this->createdAt = $createdAt;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function title() : string
    {
        return $this->title;
    }

    public function popularWords() : string
    {
        return implode(', ', $this->popularWords);
    }

    public function image() : ?string
    {
        return $this->image;
    }

    public function body() : ?string
    {
        return $this->body;
    }

    public function createdAt() : DateTimeImmutable
    {
        return $this->createdAt;
    }
}
