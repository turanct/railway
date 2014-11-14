<?php

namespace Railway;

final class Failure implements Track
{
    private $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
