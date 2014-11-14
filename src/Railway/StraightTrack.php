<?php

namespace Railway;

use Exception;
use InvalidArgumentException;

/**
 * Straight Track
 *
 * Use the Straight Track when something needs to happen to both Success and Failure cases
 */
final class StraightTrack implements Railway
{
    private $success;
    private $failure;

    public function __construct($success, $failure)
    {
        if (!is_callable($success)) {
            throw new InvalidArgumentException('The success argument should be callable.');
        }

        if (!is_callable($failure)) {
            throw new InvalidArgumentException('The failure argument should be callable.');
        }

        $this->success = $success;
        $this->failure = $failure;
    }

    public function __invoke(Track $param)
    {
        if ($param instanceof Success) {
            $returnValue = call_user_func($this->success, $param->getReturnValue());

            return new Success($returnValue);
        } else {
            $returnValue = call_user_func($this->failure, $param->getError());

            return new Failure($returnValue);
        }
    }
}
