<?php

declare(strict_types=1);

namespace MessageBus\Tests\CommandBus;

use MessageBus\CommandBus\Command;
use MessageBus\CommandBus\CommandBus;
use MessageBus\CommandBus\CouldNotResolveHandler;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;

final class CommandBusTest extends TestCase
{
    /**
     * @test
     */
    public function it_handles_command()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $container->has(Argument::type('string'))->shouldBeCalled()->willReturn(true);
        $container->get(Argument::type('string'))->shouldBeCalled()->willReturn(function () {});

        $bus = new CommandBus($container->reveal());
        $bus->handle($this->prophesize(Command::class)->reveal());
    }

    /**
     * @test
     * @expectedException MessageBus\CommandBus\CouldNotResolveHandler
     */
    public function it_handles_unresolved_command()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $container->has(Argument::type('string'))->shouldBeCalled()->willReturn(false);
        $container->get()->shouldNotBeCalled();

        $bus = new CommandBus($container->reveal());
        $bus->handle($this->prophesize(Command::class)->reveal());
    }
}
