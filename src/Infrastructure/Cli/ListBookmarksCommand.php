<?php

declare(strict_types=1);

namespace SandboxCQRS\Infrastructure\Cli;

use MessageBus\QueryBus\QueryBus;
use SandboxCQRS\Application\Query\ListBookmarks;
use SandboxCQRS\Domain\ReadModel\Bookmark;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBus;

final class ListBookmarksCommand extends Command
{
    private $queryBus;

    public function __construct(MessageBus $queryBus)
    {
        parent::__construct();

        $this->queryBus = $queryBus;
    }

    protected function configure() : void
    {
        $this
            ->setName('bookmark:list')
            ->setDescription('List all bookmarks')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $output->writeln('<info>Listing bookmarks...</info>');

        $rows = [];
        /** @var Bookmark $bookmark */
        foreach ($this->queryBus->dispatch(new ListBookmarks()) as $bookmark) {
            $rows[] = [
                $bookmark->id(),
                $bookmark->url(),
                $bookmark->title(),
                $bookmark->popularWords(),
                $bookmark->image(),
                $bookmark->createdAt()->format('Y-m-d'),
            ];
        }

        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'URL', 'Title', 'Popular words', 'Image', 'createdAt'])
            ->setRows($rows)
        ;
        $table->render();
    }
}
