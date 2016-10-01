<?php

namespace MarsRover\Navigation;

use MarsRover\EventSourcing\EventFactory;
use MarsRover\EventSourcing\EventStore;

class LandRoverCommandHandler
{
    private $eventFactory;
    private $eventStore;

    public function __construct(
        EventFactory $eventFactory,
        EventStore $eventStore
    ) {
        $this->eventFactory = $eventFactory;
        $this->eventStore = $eventStore;
    }

    public function handle(LandRoverCommand $command)
    {
        $roverLanded = $this->eventFactory->create(Events::ROVER_LANDED, [
            'x' => $command->getCoordinates()->getX(),
            'y' => $command->getCoordinates()->getY(),
            'orientation' => $command->getOrientation()->get(),
        ]);
        $this->eventStore->log($roverLanded);
    }
}
