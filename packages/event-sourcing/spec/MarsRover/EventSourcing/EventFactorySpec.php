<?php

namespace spec\MarsRover\EventSourcing;

use MarsRover\EventSourcing\Event;
use MarsRover\EventSourcing\EventFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventFactorySpec extends ObjectBehavior
{
    const NAME = 'something_happened';
    const DATA = [
        'message' => 'And now for something completly different',
    ];

    function it_can_create_events()
    {
        $this->create(self::NAME, self::DATA)->shouldHaveType(Event::class);
    }
}
