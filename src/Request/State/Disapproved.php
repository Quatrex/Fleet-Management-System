<?php

namespace Request\State;

class Disapproved extends State
{

    private static ?Disapproved $instance = null;

    private function __construct()
    {
        $this->stateID = parent::getStateID('disapproved');
    }

    public static function getInstance(): Disapproved
    {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }
}
