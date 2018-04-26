<?php

declare(strict_types=1);

namespace MessageBus\QueryBus;

final class CouldNotResolveHandler extends \LogicException
{
    public static function createFor(Command $query) : self
    {
        return new self(
            sprintf('Could not resolve a handler for "%s"', \get_class($query))
        );
    }
}
