<?php

namespace spec\MarsRover\Navigation;

use MarsRover\EventSourcing\EventFactory;
use MarsRover\EventSourcing\Event;
use MarsRover\EventSourcing\EventStore;
use MarsRover\Navigation\Events;
use MarsRover\Navigation\LandRoverCommand;
use MarsRover\Navigation\LandRoverCommandHandler;
use MarsRover\Navigation\Orientation;
use PhpSpec\ObjectBehavior;

class LandRoverCommandHandlerSpec extends ObjectBehavior
{
    const X = 23;
    const Y = 42;
    const ORIENTATION = Orientation::NORTH;

    const EVENT_NAME = Events::ROVER_LANDED;
    const EVENT_DATA = [
        'x' => self::X,
        'y' => self::Y,
        'orientation' => self::ORIENTATION,
    ];

    function it_lands_a_rover_at_given_location(
        EventFactory $eventFactory,
        Event $roverLanded,
        EventStore $eventStore
    ) {
        $this->beConstructedWith($eventFactory, $eventStore);
        $landRoverCommand = new LandRoverCommand(
            self::X,
            self::Y,
            self::ORIENTATION
        );

        $eventFactory->create(
            self::EVENT_NAME,
            self::EVENT_DATA
        )->willReturn($roverLanded);
        $eventStore->log($roverLanded)->shouldBeCalled();

        $this->handle($landRoverCommand);
    }
}
