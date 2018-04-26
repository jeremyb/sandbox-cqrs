<?php

declare(strict_types=1);

namespace SandboxCQRS\Domain\Model;

interface BookmarkRepository
{
    public function add(Bookmark $bookmark) : void;
}
