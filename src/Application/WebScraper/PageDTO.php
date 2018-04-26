<?php

declare(strict_types=1);

namespace SandboxCQRS\Application\WebScraper;

final class PageDTO
{
    private $url;
    private $domain;
    private $title;
    private $image;
    private $metaDescription;
    private $metaKeywords;
    private $tags;
    private $popularWords;
    private $pageBody;
    private $pageHtml;

    public function __construct(
        string $url,
        string $domain,
        string $title,
        ?string $image,
        string $metaDescription,
        string $metaKeywords,
        array $tags,
        array $popularWords,
        ?string $pageBody,
        ?string $pageHtml
    ) {
        $this->url = $url;
        $this->domain = $domain;
        $this->title = $title;
        $this->image = $image;
        $this->metaDescription = $metaDescription;
        $this->metaKeywords = $metaKeywords;
        $this->tags = array_map(function ($value) : string {
            return (string) $value;
        }, $tags);
        $this->popularWords = array_map(function ($value) : string {
            return (string) $value;
        }, $popularWords);
        $this->pageBody = $pageBody;
        $this->pageHtml = $pageHtml;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function domain() : string
    {
        return $this->domain;
    }

    public function title() : string
    {
        return $this->title;
    }

    public function image() : ?string
    {
        return $this->image;
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

    public function pageBody() : ?string
    {
        return $this->pageBody;
    }

    public function pageHtml() : ?string
    {
        return $this->pageHtml;
    }
}
