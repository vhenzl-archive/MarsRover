<?php

namespace MarsRover\Navigation;

class DriveRoverCommand
{
    private $instruction;

    public function __construct($instruction)
    {
        $this->instruction = new Instruction($instruction);
    }

    public function getInstruction() : Instruction
    {
        return $this->instruction;
    }
}
