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
        $location = $command->getLocation();
        $coordinates = $location->getCoordinates();
        $orientation = $location->getOrientation();
        $roverLanded = $this->eventFactory->create(Events::ROVER_LANDED, [
            'x' => $coordinates->getX(),
            'y' => $coordinates->getY(),
            'orientation' => $orientation->get(),
        ]);
        $this->eventStore->log($roverLanded);
    }
}
