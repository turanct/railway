<?php

namespace spec\Railway;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FailureSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('An error message.');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Railway\Failure');
    }

    function it_has_a_return_value()
    {
        $this->getError()->shouldReturn('An error message.');
    }
}
