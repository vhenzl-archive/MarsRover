<?php

namespace MarsRover\EventSourcing;

class EventFactory
{
    public function create(string $name, array $data) : Event
    {
        return new Event($name, $data, new \DateTime());
    }
}
