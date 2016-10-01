<?php

namespace MarsRover\EventSourcing;

interface EventFactory
{

    public function create($argument1, $argument2);
}
