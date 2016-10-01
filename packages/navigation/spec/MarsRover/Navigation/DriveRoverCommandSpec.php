<?php

namespace spec\MarsRover\Navigation;

use MarsRover\Navigation\DriveRoverCommand;
use MarsRover\Navigation\Instruction;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DriveRoverCommandSpec extends ObjectBehavior
{
    const DRIVING_INSTRUCTION = Instruction::MOVE_FORWARD;

    function it_has_a_driving_instruction()
    {
        $this->beConstructedWith(
            self::DRIVING_INSTRUCTION
        );

        $this->getInstruction()->get()->shouldBe(self::DRIVING_INSTRUCTION);
    }
}
