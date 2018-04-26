<?php

declare(strict_types=1);

namespace SandboxCQRS\Domain\Model;

final class Metadata
{
    private $title;
    private $metaDescription;
    private $metaKeywords;
    private $tags;
    private $popularWords;

    public function __construct(
        string $title,
        string $metaDescription,
        string $metaKeywords,
        array $tags,
        array $popularWords
    ) {
        $this->title = $title;
        $this->metaDescription = $metaDescription;
        $this->metaKeywords = $metaKeywords;
        $this->tags = array_map(function ($value) : string {
            return (string) $value;
        }, $tags);
        $this->popularWords = array_map(function ($value) : string {
            return (string) $value;
        }, $popularWords);
    }

    public function title() : string
    {
        return $this->title;
    }

    public function metaDescription() : string
    {
        return $this->metaDescription;
    }

    public function metaKeywords() : string
    {
        return $this->metaKeywords;
    }

    public function tags() : array
    {
        return $this->tags;
    }

    public function popularWords() : array
    {
        return $this->popularWords;
    }
}
