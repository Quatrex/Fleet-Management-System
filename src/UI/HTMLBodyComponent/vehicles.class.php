<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\CompositeBuilder;

class Vehicles extends Tab
{
    private array $vehicles;
    private CompositeBuilder $compositeBuilder;

    public function __construct(array $vehicles)
    {
        parent::__construct();
        $this->vehicles = $vehicles;
        $this->compositeBuilder = new CompositeBuilder();
    }

    public function create(): void{
        $vehicleCards = [];
        foreach ($this->vehicles as $vehicle) {
            $vehicleCard = $this->compositeBuilder
                ->createComposite('div', ['class' => 'col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description', 'id' => 'vehiclesContainer_' . htmlentities($vehicle->getField('registrationNo'))])
                ->composite()
                ->createComposite('div', ['class' => 'card text-center', 'style' => 'width: 15rem;'])
                ->addElement('img', ['class' => "card-img-top rounded-circle user-image mt-2", 'src' => "../images/default-user-image.png", 'alt' => "Driver Image"])
                ->composite()
                ->createComposite('div', ['class' => 'card-body'])
                ->addElement('h5', ['class' => 'card-title model'], [$vehicle->getField('model')])
                ->addElement('h6', ['class' => 'card-subtitle mb-2 text-muted registration'], [$vehicle->getField('registrationNo')])
                ->addElement('p', ['class' => 'card-text purchasedYear'], [$vehicle->getField('purchasedYear')])
                ->addElement('p', ['class' => 'card-text'], ['Nothing'])
                ->get()
                ->get()
                ->getComposite();
            array_push($vehicleCards, $vehicleCard);
        }
        $this->bodyComponent = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card mt-5', 'id' => 'vehiclesContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header text-white py-0"])
            ->addToContent($this->createMySearchBar('Vehicles', ['Registration No', 'Model', 'FuelType']))
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'card-body row pb-3'])
            ->addArrayToContent($vehicleCards)
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "row d-flex justify-content-center"])
            ->addElement('button', ['class' => "btn w-100 btn-light load-more mb-3 d-none mr-5 ml-5", "id" => 'vehiclesContainer_LoadMore'], ['Load More'])
            ->get()
            ->getComposite();
    }
}