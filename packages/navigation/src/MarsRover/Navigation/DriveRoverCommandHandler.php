<?php

namespace MarsRover\Navigation;

use MarsRover\EventSourcing\EventFactory;
use MarsRover\EventSourcing\EventStore;

class DriveRoverCommandHandler
{
    private $eventFactory;
    private $eventStore;

    public function __construct(EventFactory $eventFactory, EventStore $eventStore)
    {
        $this->eventFactory = $eventFactory;
        $this->eventStore = $eventStore;
    }

    public function handle(DriveRoverCommand $driveRoverCommand)
    {
        $roverDriven = $this->eventFactory->create(Events::ROVER_DRIVEN, [
            'instruction' => $driveRoverCommand->getInstruction()->get(),
        ]);
        $this->eventStore->log($roverDriven);
    }
}
