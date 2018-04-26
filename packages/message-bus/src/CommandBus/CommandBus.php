<?php

declare(strict_types=1);

namespace MessageBus\CommandBus;

use Psr\Container\ContainerInterface;

final class CommandBus
{
    private $handlerLocator;

    public function __construct(ContainerInterface $handlerLocator)
    {
        $this->handlerLocator = $handlerLocator;
    }

    public function handle(Command $command) : void
    {
        $commandClass = \get_class($command);

        if (!$this->handlerLocator->has($commandClass)) {
            throw CouldNotResolveHandler::createFor($command);
        }

        $handler = $this->handlerLocator->get($commandClass);
        $handler($command);
    }
}
