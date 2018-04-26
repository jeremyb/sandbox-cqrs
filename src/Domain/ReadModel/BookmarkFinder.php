<?php

declare(strict_types=1);

namespace SandboxCQRS\Domain\ReadModel;

interface BookmarkFinder
{
    public function findAll() : \Traversable;
}
