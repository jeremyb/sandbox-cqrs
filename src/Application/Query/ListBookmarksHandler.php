<?php

declare(strict_types=1);

namespace SandboxCQRS\Application\Query;

use SandboxCQRS\Domain\ReadModel\BookmarkFinder;

final class ListBookmarksHandler
{
    private $finder;

    public function __construct(BookmarkFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(ListBookmarks $query) : \Traversable
    {
        return $this->finder->findAll();
    }
}
