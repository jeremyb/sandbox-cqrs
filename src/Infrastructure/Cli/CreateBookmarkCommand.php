<?php

declare(strict_types=1);

namespace SandboxCQRS\Infrastructure\Cli;

use MessageBus\CommandBus\CommandBus;
use SandboxCQRS\Application\Command\CreateBookmark;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateBookmarkCommand extends Command
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        parent::__construct();

        $this->commandBus = $commandBus;
    }

    protected function configure() : void
    {
        $this
            ->setName('bookmark:create')
            ->setDescription('Create a new bookmark')
            ->addArgument('url', InputArgument::REQUIRED, 'URL to add to bookmarks')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $output->writeln('<info>Creating a new bookmark from URL</info>');
        $this->commandBus->handle(new CreateBookmark($input->getArgument('url')));
        $output->writeln('<info>New bookmark added</info>');
    }
}
