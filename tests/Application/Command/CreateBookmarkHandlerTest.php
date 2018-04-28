<?php

declare(strict_types=1);

namespace SandboxCQRS\Tests\Application\Command;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use SandboxCQRS\Application\Command\CreateBookmark;
use SandboxCQRS\Application\Command\CreateBookmarkHandler;
use SandboxCQRS\Application\WebScraper\PageDTO;
use SandboxCQRS\Application\WebScraper\Scraper;
use SandboxCQRS\Domain\Model\Bookmark;
use SandboxCQRS\Domain\Model\BookmarkRepository;
use SandboxCQRS\Domain\Model\Url;

final class CreateBookmarkHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function it_handles_bookmark_creation()
    {
        $scraper = $this->prophesize(Scraper::class);
        $scraper
            ->parse(Url::fromString('http://symfony.com/'))
            ->shouldBeCalled()
            ->willReturn(new PageDTO(
                'http://symfony.com/',
                'symfony.com',
                'Symfony, High Performance PHP Framework for Web Development',
                null,
                'Symfony is a set of reusable PHP components and a PHP framework to build web applications, APIs, microservices and web services.',
                'symfony3, symfony2, symfony, project, framework, php, php5, php7, open-source, components, symphony, symfony framework, symfony tutorial',
                [],
                [],
                null,
                null
            ));

        $repository = $this->prophesize(BookmarkRepository::class);
        $repository->add(Argument::type(Bookmark::class))->shouldBeCalled();

        $handler = new CreateBookmarkHandler(
            $scraper->reveal(),
            $repository->reveal()
        );
        $handler(new CreateBookmark('http://symfony.com/'));
    }
}
