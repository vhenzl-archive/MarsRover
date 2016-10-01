<?php

namespace spec\MarsRover\Navigation;

use MarsRover\EventSourcing\Event;
use MarsRover\EventSourcing\EventFactory;
use MarsRover\EventSourcing\EventStore;
use MarsRover\Navigation\DriveRoverCommand;
use MarsRover\Navigation\DriveRoverCommandHandler;
use MarsRover\Navigation\Events;
use MarsRover\Navigation\Instruction;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DriveRoverCommandHandlerSpec extends ObjectBehavior
{
    const DRIVING_INSTRUCTION = Instruction::MOVE_FORWARD;

    const EVENT_NAME =  Events::ROVER_DRIVEN;
    const EVENT_DATA = [
        'instruction' => self::DRIVING_INSTRUCTION,
    ];

    function it_drives_a_rover_with_given_instruction(
        EventFactory $eventFactory,
        Event $roverDriven,
        EventStore $eventStore
    ) {
        $this->beConstructedWith($eventFactory, $eventStore);
        $driveRoverCommand = new DriveRoverCommand(
            self::DRIVING_INSTRUCTION
        );

        $eventFactory->create(
            self::EVENT_NAME,
            self::EVENT_DATA
        )->willReturn($roverDriven);
        $eventStore->log($roverDriven)->shouldBeCalled();

        $this->handle($driveRoverCommand);
    }
}
