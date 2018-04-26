<?php

declare(strict_types=1);

namespace SandboxCQRS\Domain\Model;

final class Url
{
    private $url;
    private $domain;

    public static function fromString(string $url) : self
    {
        return new self($url, null);
    }

    public function __construct(string $url, ?string $domain)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Not a valid URL');
        }

        $this->url = $url;
        $this->domain = $domain;
    }

    public function __toString() : string
    {
        return $this->url;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function domain() : ?string
    {
        return $this->domain;
    }

    public function withDomain(?string $domain) : self
    {
        return new self($this->url, $domain);
    }
}
