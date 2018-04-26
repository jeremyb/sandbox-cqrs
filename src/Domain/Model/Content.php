<?php

declare(strict_types=1);

namespace SandboxCQRS\Domain\Model;

final class Content
{
    private $body;
    private $html;

    public function __construct(
        ?string $body,
        ?string $html
    ) {
        $this->body = $body;
        $this->html = $html;
    }

    public function body() : ?string
    {
        return $this->body;
    }

    public function html() : ?string
    {
        return $this->html;
    }
}
