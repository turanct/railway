<?php

namespace spec\Railway;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StraightTrackSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $callable = function($param) { return; };
        $this->beConstructedWith($callable, $callable);
        $this->shouldHaveType('Railway\StraightTrack');
    }

    function it_returns_failure_when_given_failure()
    {
        $callable = function($param) { return $param . 'bar'; };
        $this->beConstructedWith($callable, $callable);

        $failure = new \Railway\Failure('foo');
        $result = new \Railway\Failure('foobar');

        $this->__invoke($failure)->shouldBeLike($result);
    }

    function it_returns_success_when_given_success()
    {
        $callable = function($param) { return $param . 'bar'; };
        $this->beConstructedWith($callable, $callable);

        $success = new \Railway\Success('foo');
        $result = new \Railway\Success('foobar');

        $this->__invoke($success)->shouldBeLike($result);
    }
}
