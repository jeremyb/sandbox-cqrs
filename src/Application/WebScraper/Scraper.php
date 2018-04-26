<?php

declare(strict_types=1);

namespace SandboxCQRS\Application\WebScraper;

use SandboxCQRS\Domain\Model\Url;

interface Scraper
{
    public function parse(Url $url) : PageDTO;
}
