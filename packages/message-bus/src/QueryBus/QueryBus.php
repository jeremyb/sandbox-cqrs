<?php

declare(strict_types=1);

namespace MessageBus\QueryBus;

use Psr\Container\ContainerInterface;

final class QueryBus
{
    private $handlerLocator;

    public function __construct(ContainerInterface $handlerLocator)
    {
        $this->handlerLocator = $handlerLocator;
    }

    public function handle(Query $query) : \Traversable
    {
        $queryClass = \get_class($query);

        if (!$this->handlerLocator->has($queryClass)) {
            throw CouldNotResolveHandler::createFor($query);
        }

        $handler = $this->handlerLocator->get($queryClass);

        return $handler($query);
    }
}
