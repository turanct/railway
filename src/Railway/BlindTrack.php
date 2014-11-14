<?php

namespace Railway;

use Exception;
use InvalidArgumentException;

/**
 * Blind Track
 *
 * Use the Blind Track to wrap functions that don't have a return value. We'll just pass along
 * the argument to the next track.
 */
final class BlindTrack implements Railway
{
    private $f;

    public function __construct($f)
    {
        if (!is_callable($f)) {
            throw new InvalidArgumentException('The constructor argument should be callable.');
        }

        $this->f = $f;
    }

    public function __invoke(Track $param)
    {
        if ($param instanceof Failure) {
            return $param;
        }

        try {
            call_user_func($this->f, $param->getReturnValue());

            return $param;
        } catch (Exception $e) {
            return new Failure($e->getMessage());
        }
    }
}
