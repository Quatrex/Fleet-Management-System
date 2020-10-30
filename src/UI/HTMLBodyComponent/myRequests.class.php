<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\CompositeBuilder;

class MyRequests extends Tab
{
    private string $state;
    private string $header;
    private array $requests;
    private CompositeBuilder $compositeBuilder;

    public function __construct(array $requests, string $state, $header = '')
    {
        parent::__construct();
        $this->state = $state;
        $this->header = $header;
        $this->requests = $requests;
        $this->compositeBuilder = new CompositeBuilder();
    }

    public function create(): void
    {
        $i = 0;
        $requestElements = [];
        foreach ($this->requests as $request) {
            $requestElement = $this->compositeBuilder
                ->createComposite('div', ['class' => 'card request-card detail-description', 'id' => strtolower($this->state) . 'RequestsCard_' . htmlentities($request->getField('requestID')), 'style' => 'z-index:2;'])
                ->composite()
                ->createComposite('div', ['class' => 'description'])
                //->addElement('span',['class'=>'request-id','id'=> strtolower($state) . '-request-' . $i],['Requset id: ' . htmlentities($request->getField('requestID'))])
                ->addElement('h1', ['class' => 'card-title'], ['For: ' . htmlentities($request->getField('purpose'))])
                ->composite()
                ->createComposite('div', ['class' => 'row', 'style' => 'padding-left:1rem;'])
                ->addElement('h2', ['class' => 'card-title', 'style' => 'color:rgba(95,99,104,0.9);'], ['Status: '])
                ->addElement('h2', ['class' => 'card-title', 'style' => 'color:' . $this->getColorForState(htmlentities($request->getField('state'))) . ';'], [htmlentities($request->getField('state'))])
                ->get()
                ->addElement('hr')
                ->composite()
                ->createComposite('div', ['class' => 'row justify-content-between'])
                ->composite()
                ->createComposite('div', ['class' => 'col-sm-3'])
                ->addElement('p', [], ['On: ' . htmlentities($request->getField('dateOfTrip'))])
                ->get()
                ->composite()
                ->createComposite('div', ['class' => 'col-sm-3'])
                ->addElement('p', [], ['At: ' . htmlentities($request->getField('timeOfTrip'))])
                ->get()
                ->composite()
                ->createComposite('div', ['class' => 'col-sm-3'])
                ->addElement('p', [], ['From: ' . htmlentities($request->getField('pickLocation'))])
                ->get()
                ->composite()
                ->createComposite('div', ['class' => 'col-sm-3'])
                ->addElement('p', [], ['To: ' . htmlentities($request->getField('dropLocation'))])
                ->get()
                ->composite()
                ->createComposite('div', ['class' => 'col'])
                ->addElement('p', ['class' => 'more'], [])
                ->get()
                ->get()
                ->get()
                ->getComposite();
            array_push($requestElements, $requestElement);
            $i++;
        }
        $this->bodyComponent = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card', 'id' => strtolower($this->state) . 'RequestsContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header text-white py-0"])
            ->addToContent($this->createMySearchBar($this->header, ['Created Date', 'Pick Location', 'Drop Location', 'Time Of Trip', 'Date Of Trip', 'Purpose', 'State']))
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'card-body pb-3'])
            ->addArrayToContent($requestElements)
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "row d-flex justify-content-center"])
            ->addElement('button', ['class' => "btn w-100 btn-light load-more mb-3 d-none mr-5 ml-5", "id" => strtolower($this->state) . 'RequestsContainer_LoadMore'], ['Load More'])
            ->get()
            ->getComposite();
    }

    private function getColorForState(string $state)
    {
        switch ($state) {
            case 'Justified':
                return 'darkorange';
                break;
            case 'Approved':
                return 'green';
                break;
            case 'Denied':
                return 'red';
                break;
            case 'Disapproved':
                return 'red';
                break;
            case 'Completed':
                return 'blue';
                break;
            default:
                return 'rgba(95,99,104,0.9)';
                break;
        }
    }
}
