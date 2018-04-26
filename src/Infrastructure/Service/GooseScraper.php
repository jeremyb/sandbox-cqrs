<?php

declare(strict_types=1);

namespace SandboxCQRS\Infrastructure\Service;

use Goose\Client;
use SandboxCQRS\Application\WebScraper\PageDTO;
use SandboxCQRS\Application\WebScraper\Scraper;
use SandboxCQRS\Domain\Model\Url;

final class GooseScraper implements Scraper
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function parse(Url $url) : PageDTO
    {
        $page = $this->client->extractContent((string) $url);
        if (null === $page) {
            throw new \RuntimeException('Error to get the page');
        }

        return new PageDTO(
            $page->getCanonicalLink() ?: $page->getFinalUrl(),
            $page->getDomain(),
            $page->getTitle(),
            null !== $page->getTopImage() ? $page->getTopImage()->getImageSrc() : null,
            $page->getMetaDescription(),
            $page->getMetaKeywords(),
            $page->getTags(),
            array_keys($page->getPopularWords()),
            $page->getCleanedArticleText(),
            $page->getHtmlArticle()
        );
    }
}
