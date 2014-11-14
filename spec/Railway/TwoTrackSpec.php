<?php

namespace spec\Railway;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TwoTrackSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $callable = function($param) { return; };
        $this->beConstructedWith($callable);
        $this->shouldHaveType('Railway\TwoTrack');
    }

    function it_returns_failure_when_given_failure()
    {
        $callable = function($param) { return $param; };
        $this->beConstructedWith($callable);

        $failure = new \Railway\Failure('failure');

        $this->__invoke($failure)->shouldReturn($failure);
    }

    function it_returns_success_when_given_success_and_no_exceptions_raised()
    {
        $callable = function($param) { return $param . 'bar'; };
        $this->beConstructedWith($callable);

        $success = new \Railway\Success('foo');
        $result = new \Railway\Success('foobar');

        $this->__invoke($success)->shouldBeLike($result);
    }

    function it_returns_failure_when_given_success_and_exceptions_raised()
    {
        $callable = function($param) { throw new \Exception('foobar'); };
        $this->beConstructedWith($callable);

        $success = new \Railway\Success('foo');
        $result = new \Railway\Failure('foobar');

        $this->__invoke($success)->shouldBeLike($result);
    }
}
