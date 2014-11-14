<?php

namespace spec\Railway;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SuccessSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('foobar');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Railway\Success');
    }

    function it_has_a_return_value()
    {
        $this->getReturnValue()->shouldReturn('foobar');
    }
}
