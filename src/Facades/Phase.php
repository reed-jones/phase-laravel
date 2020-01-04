<?php

namespace ReedJones\Phase\Facades;

use Illuminate\Support\Facades\Facade;
use ReedJones\Phase\Factories\PhaseFactory;

class Phase extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return PhaseFactory::class;
    }
}
