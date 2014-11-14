<?php

namespace Railway;

interface Railway
{
    /**
     * @param Track $track
     * @return Track
     */
    public function __invoke(Track $param);
}
