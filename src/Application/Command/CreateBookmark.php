<?php

declare(strict_types=1);

namespace SandboxCQRS\Application\Command;

use MessageBus\CommandBus\Command;

final class CreateBookmark implements Command
{
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function url() : string
    {
        return $this->url;
    }
}
