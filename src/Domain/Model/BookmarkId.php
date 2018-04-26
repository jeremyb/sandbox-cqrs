<?php

declare(strict_types=1);

namespace SandboxCQRS\Domain\Model;

final class BookmarkId
{
    private $value;

    public static function fromString(string $value) : self
    {
        return new self($value);
    }

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString() : string
    {
        return $this->value;
    }

    public function value() : string
    {
        return $this->value;
    }
}
