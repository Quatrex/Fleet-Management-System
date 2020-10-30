<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\CompositeBuilder;

class Drivers extends Tab
{
    private array $drivers;
    private CompositeBuilder $compositeBuilder;

    public function __construct(array $drivers)
    {
        parent::__construct();
        $this->drivers = $drivers;
        $this->compositeBuilder = new CompositeBuilder();
    }

    public function create(): void{
        $driverCards = [];
        foreach ($this->drivers as $driver) {
            $driverCard = $this->compositeBuilder
                ->createComposite('div', ['class' => 'col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description', 'id' => 'driverContainer_' . htmlentities($driver->getField('driverId'))])
                ->composite()
                ->createComposite('div', ['class' => 'card text-center', 'style' => 'width: 15rem;'])
                ->addElement('img', ['class' => "card-img-top rounded-circle user-image mt-2", 'src' => "../images/default-user-image.png", 'alt' => "Driver Image"])
                ->composite()
                ->createComposite('div', ['class' => 'card-body'])
                ->addElement('h5', ['class' => 'card-title firstName lastName'], [$driver->getField('firstName') . ' ' . $driver->getField('lastName')])
                ->addElement('h6', ['class' => 'card-subtitle mb-2 text-muted driverId'], [$driver->getField('driverId')])
                ->addElement('p', ['class' => 'card-text assignedVehicleId'], [$driver->getField('assignedVehicleId')])
                ->addElement('p', ['class' => 'card-text'], ["Empty"])
                ->get()
                ->get()
                ->getComposite();
            array_push($driverCards, $driverCard);
        }
        $this->bodyComponent = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card', 'id' => 'driverContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header text-white py-0"])
            ->addToContent($this->createMySearchBar('Driver', ['First Name', 'Last Name', 'Driver ID']))
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'card-body row pb-3'])
            ->addArrayToContent($driverCards)
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "row d-flex justify-content-center"])
            ->addElement('button', ['class' => "btn w-100 btn-light load-more mb-3 d-none mr-5 ml-5", "id" => 'driverContainer_LoadMore'], ['Load More'])
            ->get()
            ->getComposite();
    }
}