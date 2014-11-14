<?php

namespace Railway;

use Exception;
use InvalidArgumentException;

/**
 * TwoTrack
 *
 * Use the TwoTrack to wrap normal functions with a return value, that throw exceptions.
 * If it gets a Failure as argument, or an exception is thrown, we move further down the Failure Track.
 * Else, Success track!
 */
final class TwoTrack implements Railway
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
            $returnValue = call_user_func($this->f, $param->getReturnValue());

            return new Success($returnValue);
        } catch (Exception $e) {
            return new Failure($e->getMessage());
        }
    }
}
