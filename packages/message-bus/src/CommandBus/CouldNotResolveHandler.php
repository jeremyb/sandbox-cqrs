<?php

declare(strict_types=1);

namespace MessageBus\CommandBus;

final class CouldNotResolveHandler extends \LogicException
{
    public static function createFor(Command $command) : self
    {
        return new self(
            sprintf('Could not resolve a handler for "%s"', \get_class($command))
        );
    }
}
