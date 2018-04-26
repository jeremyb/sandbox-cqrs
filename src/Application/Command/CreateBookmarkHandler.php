<?php

declare(strict_types=1);

namespace SandboxCQRS\Application\Command;

use Ramsey\Uuid\Uuid;
use SandboxCQRS\Application\WebScraper\Scraper;
use SandboxCQRS\Domain\Model\Bookmark;
use SandboxCQRS\Domain\Model\BookmarkId;
use SandboxCQRS\Domain\Model\BookmarkRepository;
use SandboxCQRS\Domain\Model\Content;
use SandboxCQRS\Domain\Model\Image;
use SandboxCQRS\Domain\Model\Metadata;
use SandboxCQRS\Domain\Model\Url;

final class CreateBookmarkHandler
{
    private $scraper;
    private $repository;

    public function __construct(Scraper $scraper, BookmarkRepository $repository)
    {
        $this->scraper = $scraper;
        $this->repository = $repository;
    }

    public function __invoke(CreateBookmark $command) : void
    {
        $pageDto = $this->scraper->parse(
            Url::fromString($command->url())
        );

        $this->repository->add(
            new Bookmark(
                BookmarkId::fromString((string) Uuid::uuid4()),
                new Url($pageDto->url(), $pageDto->domain()),
                new Metadata(
                    $pageDto->title(),
                    $pageDto->metaDescription(),
                    $pageDto->metaKeywords(),
                    $pageDto->tags(),
                    $pageDto->popularWords()
                ),
                $pageDto->image() ? Image::fromString($pageDto->image()) : null,
                new Content($pageDto->pageBody(), $pageDto->pageHtml())
            )
        );
    }
}
