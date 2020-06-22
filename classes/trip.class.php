<?php
class Trip
{
    private Request $request;
    private Vehicle $vehicle;
    private Driver $driver;

    function __construct($request, $vehicle, $driver)
    {
        $this->request = $request;
        $this->vehicle = $vehicle;
        $this->driver = $driver;
    }

    public function getDriver() {return $this->driver;}
    public function getVehicle() {return $this->vehicle;}
}