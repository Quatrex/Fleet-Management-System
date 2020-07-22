<?php

namespace UI;

class HTMLBuilder
{
    private static ?HTMLBuilder $instance = null;
    private CompositeBuilder $compositeBuilder;
    private ElementBuilder $elementBuilder;
    private array $contents = [];
    private array $secNavList=[];
    private array $secTabs=[];
    private array $subTabContents=[];

    private function __construct()
    {
        $this->compositeBuilder=new CompositeBuilder();
        $this->elementBuilder= ElementBuilder::getInstance();
    }

    public static function getInstance(): HTMLBuilder
    {
        if (self::$instance == null)
            self::$instance = new self;
        return self::$instance;
    }

    public function createMainNavBar(array $navList=[]):HTMLBuilder
    {
        $i=0;
        $navComList=[];
        foreach ($navList as $nav) {
            
            if ($i==0) {
                $this->compositeBuilder
                    ->createComposite('li',['class'=>"nav-item hvrcenter active", 'data-toggle'=>str_replace(' ','',$nav)]);
            } else {
                $this->compositeBuilder
                    ->createComposite('li',['class'=>"nav-item hvrcenter mr-2", 'data-toggle'=>str_replace(' ','',$nav)]);
            }
            
            $navCom=$this->compositeBuilder
                ->addElement('a',['class'=>'nav-link'],[$nav])
                ->getComposite();
            array_push($navComList,$navCom);
            $i++;
        }
        $mainNavBar=
        $this->compositeBuilder
            ->createComposite('nav' ,['class'=>"main-nav navbar navbar-expand-md navbar-dark py-0"])
            ->composite()
                ->createComposite('a',['class'=>"navbar-brand mr-auto" ,'href'=>"#"])
                ->addElement('img',['src'=>"../images/national-logo.png", 'class'=>"logo img-fluid"])
                ->get()
            ->composite()
                ->createComposite('button',['class'=>"navbar-toggler my-2", 'type'=>"button", 'data-toggle'=>"collapse" ,'data-target'=>"#navbarContent"])
                ->addElement('span',['class'=>"navbar-toggler-icon"])
                ->get()
            ->composite()
                ->createComposite('div',['class'=>"collapse tab-info navbar-collapse", 'id'=>"navbarContent"])
                ->composite()
                    ->createComposite('ul',['class'=>'navbar-nav ml-auto'])
                    ->addArrayToContent($navComList)
                    ->composite()
                        ->createComposite('li',['class'=>'nav-item dropdown'])
                        ->composite()
                            ->createComposite('a',['class'=>"nav-link dropdown-toggle", 'id'=>"navbarDropdownMenuLink-55", 'data-toggle'=>"dropdown", 'aria-haspopup'=>"true", 'aria-expanded'=>"false"])
                            ->addElement('img',['src'=>"../images/default-user-image.png", 'class'=>"rounded-circle user-image mt-2", 'style'=>"height:35px;"])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>"dropdown-menu dropdown-menu-lg-right dropdown-secondary profile-dropdown", 'aria-labelledby'=>"navbarDropdownMenuLink-55", 'style'=>"position:absolute"])
                            ->composite()
                                ->createComposite('div',['class'=>"user-dropdown dropdown-content"])
                                ->addElement('img',['src'=>"../images/default-user-image.png"])
                                ->composite()
                                    ->createComposite('div',['class'=>'container'])
                                    ->addElement('p')
                                    ->addElement('p',['class'=>"name-profile-dd"])
                                    ->addElement('p',['class'=>"name-profile-dd"])
                                    ->addElement('p',['class'=>"mail-profile-dd"])
                                    ->addElement('p')
                                    ->addElement('button',['type'=>"button", 'class'=>"btn btn-light mx-auto my-2", 'id'=>"edit-account-info-btn"],['Edit account info'])
                                    ->get()
                                ->get()
                            ->composite()
                                ->createComposite('div',['class'=>"footer-profile"])
                                ->addElement('a',['type'=>"button", 'class'=>"btn btn-light", 'href'=>"../func/logout.php"],['Sign out'])
                                ->get()
                            ->get()
                        ->get()
                    ->get()
                ->get()
            ->getComposite();
        array_push($this->contents,$mainNavBar);
        return $this;
    }

    public function createSecondaryNavBar(array $navList):HTMLBuilder
    {
        $i=0;
        $navComList=[];
        foreach ($navList as $nav) {
            
            if ($i==0) {
                $this->elementBuilder
                    ->createElement('a', ['class'=>"nav-item nav-link active hvrcenter", 'data-toggle'=>"tab", 'href'=>'#'.str_replace(' ','',$nav)],[strpos($nav,'History')?'History':$nav]);
            } else {
                $this->elementBuilder
                    ->createElement('a', ['class'=>"nav-item nav-link hvrcenter", 'data-toggle'=>"tab", 'href'=>'#'.str_replace(' ','',$nav)],[strpos($nav,'History')?'History':$nav]);
            }
            
            $navCom=$this->elementBuilder->getElement();
            array_push($navComList,$navCom);
            $i++;
        }
        $secNavBar=
        $this->compositeBuilder
            ->createComposite('div',['class'=>'secondary-nav-bar'])
            ->composite()
                ->createComposite('nav',['class'=>'pt-3 mb-3'])
                ->composite()
                    ->createComposite('div',['class'=>'nav nav-pills justify-content-start ml-5'])
                    ->addArrayToContent($navComList)
                    ->get()
                ->get()
            ->getComposite();
        array_push($this->secNavList,$secNavBar);
        return $this;
    }

    public function myRequests(array $requests,string $state,$header=''): HTMLBuilder
    {
        $i = 0;
        $requestElements = [];
        foreach ($requests as $request) {
            $requestElement= $this->compositeBuilder
                ->createComposite('div',['class' => 'card request-card','id'=> strtolower($state) . 'RequestCard-'.htmlentities($request->getField('requestID')),'style'=>'z-index:2;'])
                ->composite()
                    ->createComposite('div',['class'=>'description'])
                    //->addElement('span',['class'=>'request-id','id'=> strtolower($state) . '-request-' . $i],['Requset id: ' . htmlentities($request->getField('requestID'))])
                    ->addElement('h1',['class'=>'card-title'],['For: ' . htmlentities($request->getField('purpose'))])
                    ->composite()
                        ->createComposite('div',['class'=>'row','style'=>'padding-left:1rem;'])
                        ->addElement('h2',['class'=>'card-title','style'=>'color:rgba(95,99,104,0.9);'],['Status: ' ])
                        ->addElement('h2',['class'=>'card-title','style'=>'color:'.$this->getColorForState(htmlentities($request->getField('state'))).';'],[htmlentities($request->getField('state'))])
                        ->get()
                    ->addElement('hr')
                    ->composite()
                        ->createComposite('div',['class'=>'row justify-content-between'])
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['On: ' . htmlentities($request->getField('dateOfTrip'))])
                            ->get() 
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['At: ' . htmlentities($request->getField('timeOfTrip'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['From: ' . htmlentities($request->getField('pickLocation'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['To: ' . htmlentities($request->getField('dropLocation'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col'])
                            ->addElement('p',['class'=>'more'], [])
                            ->get()
                        ->get()
                    ->get()
                ->getComposite();
            array_push($requestElements,$requestElement);
            $i++;
        }
        $card= $this->compositeBuilder
            ->createComposite('div',['class'=>'card mt-5'])
            ->addElement('h3',['class'=>"card-header bg-dark text-white"],[$header])
            ->composite()
                ->createComposite('div',['class'=>'card-body'])
                ->addArrayToContent($requestElements)
                ->get()
            ->getComposite();
        array_push($this->subTabContents,$card);
        return $this;
    }

    public function awaitingRequests(array $requests, string $state,string $header): HTMLBuilder
    {
        $i = 0;
        $requestElements = [];
        foreach ($requests as $request) {
            $requestElement= $this->compositeBuilder
                ->createComposite('div',['class' => 'card request-card','id'=> strtolower($state) . 'RequestCard-'.htmlentities($request->getField('requestID')),'style'=>'z-index:2;'])
                ->composite()
                    ->createComposite('div',['class'=>'description'])
                    //->addElement('span',['class'=>'request-id','id'=> strtolower($state) . '-request-' . $i],['Requset id: ' . htmlentities($request->getField('requestID'))])
                    ->addElement('h1',['class'=>'card-title'],['For: ' . htmlentities($request->getField('purpose'))])
                    ->addElement('h2',['class'=>'card-title'],['By: ' . htmlentities(($request->getField('requester'))->getField('firstName') . ' ' . ($request->getField('requester'))->getField('lastName'))])
                    ->addElement('h2',['class'=>'card-title hidden-details'],['Designation: ' . htmlentities(($request->getField('requester'))->getField('designation'))])
                    ->addElement('hr')
                    ->composite()
                        ->createComposite('div',['class'=>'row justify-content-between'])
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['On: ' . htmlentities($request->getField('dateOfTrip'))])
                            ->get() 
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['At: ' . htmlentities($request->getField('timeOfTrip'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['From: ' . htmlentities($request->getField('pickLocation'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['To: ' . htmlentities($request->getField('dropLocation'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col'])
                            ->addElement('p',['class'=>'more'], [])
                            ->get()
                        ->get()
                    ->get()
                ->getComposite();
            array_push($requestElements,$requestElement);
            $i++;
        }
        $card= $this->compositeBuilder
            ->createComposite('div',['class'=>'card mt-5'])
            ->addElement('h3',['class'=>"card-header bg-dark text-white"],[$header])
            ->composite()
                ->createComposite('div',['class'=>'card-body'])
                ->addArrayToContent($requestElements)
                ->get()
            ->getComposite();
        array_push($this->subTabContents,$card);
        return $this;
    }

    public function drivers(array $drivers):HTMLBuilder
    {
        $driverCards=[];
        foreach ($drivers as $driver) {
            $driverCard=$this->compositeBuilder
                ->createComposite('div',['class'=>'col-lg-3 col-md-4 col-sm-6 col-xs-12'])
                ->composite()
                    ->createComposite('div',['class'=>'card text-center', 'id'=>'driver-card-'.htmlentities($driver->getField('driverId')), 'style'=>'width: 15rem;'])
                    ->addElement('img',['class'=>"card-img-top rounded-circle user-image mt-2", 'src'=>"../images/default-user-image.png", 'alt'=>"Driver Image"])
                    ->composite()
                        ->createComposite('div',['class'=>'card-body'])
                        ->addElement('h5',['class'=>'card-title'],[$driver->getField('firstName') . ' ' . $driver->getField('lastName') ])
                        ->addElement('h6',['class'=>'card-subtitle mb-2 text-muted'],[$driver->getField('driverId')])
                        ->addElement('p',['class'=>'card-text'],[$driver->getField('assignedVehicleId')])
                        ->addElement('p',['class'=>'card-text'],["Empty"])
                        ->get()
                    ->get()
                ->getComposite();
            array_push($driverCards,$driverCard);
        }
        $card= $this->compositeBuilder
            ->createComposite('div',['class'=>'card mt-5'])
            ->addElement('h3',['class'=>"card-header bg-dark text-white"],['Drivers'])
            ->composite()
                ->createComposite('div',['class'=>'card-body row'])
                ->addArrayToContent($driverCards)
                ->get()
            ->getComposite();
        array_push($this->subTabContents,$card);
        return $this;
    }

    public function vehicles(array $vehicles):HTMLBuilder
    {
        $vehicleCards=[];
        foreach ($vehicles as $vehicle) {
            $vehicleCard=$this->compositeBuilder
                ->createComposite('div',['class'=>'col-lg-3 col-md-4 col-sm-6 col-xs-12'])
                ->composite()
                    ->createComposite('div',['class'=>'card text-center', 'id'=>'vehicle-card-'.htmlentities($vehicle->getField('registrationNo')), 'style'=>'width: 15rem;'])
                    ->addElement('img',['class'=>"card-img-top rounded-circle user-image mt-2", 'src'=>"../images/default-user-image.png", 'alt'=>"Driver Image"])
                    ->composite()
                        ->createComposite('div',['class'=>'card-body'])
                        ->addElement('h5',['class'=>'card-title'],[$vehicle->getField('model')])
                        ->addElement('h6',['class'=>'card-subtitle mb-2 text-muted'],[$vehicle->getField('registrationNo')])
                        ->addElement('p',['class'=>'card-text'],[$vehicle->getField('purchasedYear')])
                        ->addElement('p',['class'=>'card-text'],['Nothing'])
                        ->get()
                    ->get()
                ->getComposite();
            array_push($vehicleCards,$vehicleCard);
        }
        $card= $this->compositeBuilder
            ->createComposite('div',['class'=>'card mt-5'])
            ->addElement('h3',['class'=>"card-header bg-dark text-white"],['Vehicles'])
            ->composite()
                ->createComposite('div',['class'=>'card-body row'])
                ->addArrayToContent($vehicleCards)
                ->get()
            ->getComposite();
        array_push($this->subTabContents,$card);
        return $this;
    }

    public function employees(array $employees):HTMLBuilder
    {
        $employeeCards=[];
        foreach ($employees as $employee) {
            $employeeCard=$this->compositeBuilder
                ->createComposite('div',['class'=>'col-lg-3 col-md-4 col-sm-6 col-xs-12'])
                ->composite()
                    ->createComposite('div',['class'=>'card text-center', 'id'=>'employee-card-'.htmlentities($employee->getField('empID')), 'style'=>'width: 15rem;'])
                    ->addElement('img',['class'=>"card-img-top rounded-circle user-image mt-2", 'src'=>"../images/default-user-image.png", 'alt'=>"Driver Image"])
                    ->composite()
                        ->createComposite('div',['class'=>'card-body'])
                        ->addElement('h5',['class'=>'card-title'],[$employee->getField('firstName') . ' ' . $employee->getField('lastName')])
                        ->addElement('h6',['class'=>'card-subtitle mb-2 text-muted'],['Designation: ' . $employee->getField('designation')])
                        ->addElement('h6',['class'=>'card-subtitle mb-2 text-muted'],['Role: ' . $employee->getField('position')])
                        ->addElement('p',['class'=>'card-text'],[$employee->getField('email')])
                        ->get()
                    ->get()
                ->getComposite();
            array_push($employeeCards,$employeeCard);
        }
        $card= $this->compositeBuilder
            ->createComposite('div',['class'=>'card mt-5'])
            ->addElement('h3',['class'=>"card-header bg-dark text-white"],['Employees'])
            ->composite()
                ->createComposite('div',['class'=>'card-body row'])
                ->addArrayToContent($employeeCards)
                ->get()
            ->getComposite();
        array_push($this->subTabContents,$card);
        return $this;
    }

    public function buildSecTabBody($tabids):HTMLBuilder
    {
        $i=0;
        $tabComList=[];
        foreach ($this->subTabContents as $tab) {
            
            if ($i==0) {
                $this->compositeBuilder
                    ->createComposite('div',['class'=>"tab-pane fade active show",'id'=>$tabids[$i],'role'=>'tabpanel']);
            } else {
                $this->compositeBuilder
                    ->createComposite('div',['class'=>"tab-pane fade",'id'=>$tabids[$i],'role'=>'tabpanel']);
            }
            $buttonAttributes=$this->getButtonAttributes($tabids[$i]);
            $tabCom=$this->compositeBuilder
                ->addElement(($buttonAttributes==[]) ? 'div' : 'input', $buttonAttributes)
                ->addToContent($tab)
                ->getComposite();
            array_push($tabComList,$tabCom);
            $i++;
        }
        $subBody= $this->compositeBuilder
            ->createComposite('div',['class'=>'container-fluid'])
            ->composite()
                ->createComposite('div',['class'=>'tab-content'])
                ->addArrayToContent($tabComList)
                ->get()
            ->getComposite();
        array_push($this->secTabs,$subBody);
        $this->subTabContents=[];
        return $this;
    }

    public function createMainNavHierachy($tabids=[]):HTMLBuilder
    {
        $mainTabComList=[];
        for ($i=0; $i < sizeof($this->secNavList); $i++) {
            
            if ($i==0) {
                $tabClass='main-tabs tab-pane fade active show';
            } else {
                $tabClass='main-tabs tab-pane fade';
            }
            if ($tabids==[]) {
                $this->compositeBuilder
                    ->createComposite('div',['class'=>$tabClass,'role'=>'tabpanel']);
            } else {
                $this->compositeBuilder
                    ->createComposite('div',['class'=>$tabClass,'id'=>$tabids[$i],'role'=>'tabpanel']);
            }
            
            $tabCom=$this->compositeBuilder
                ->addArrayToContent([$this->secNavList[$i],$this->secTabs[$i]])
                ->getComposite();
            array_push($mainTabComList,$tabCom);
        }
        $mainBody= $this->compositeBuilder
            ->createComposite('div',['class'=>'tab-content main-tab-pane'])
            ->composite()
                ->createComposite('div',['class'=>'tab-content'])
                ->addArrayToContent($mainTabComList)
                ->get()
            ->getComposite();
        array_push($this->contents,$mainBody);
        return $this;
    }

    public function show()
    {
        foreach ($this->contents as $content) {
            $content->show();
        }
    }

    private function getButtonAttributes($tabid)
    {
        switch ($tabid) {
            case 'PendingRequests':
                return ['type' => 'button', 'value' => 'New Request', 'class' => "btn btn-primary rounded shadow p-3 mb-4", "id" => "request-vehicle-button"];
                break;
            case 'OngoingRequests':
                return ['type' => 'button', 'value' => 'New Request', 'class' => "btn btn-primary rounded shadow p-3 mb-4", "id" => "request-vehicle-button"];
                break;
            case 'History':
                return ['type' => 'button', 'value' => 'New Request', 'class' => "btn btn-primary rounded shadow p-3 mb-4", "id" => "request-vehicle-button"];
                break;
            case 'Employees': 
                return ['type'=>"button", 'value'=>"Add Employee", 'class'=>"btn btn-primary mb-3", 'id'=>"add-employee-button"];
                break;
            case 'Drivers': 
                return  ($_SESSION['position'] == 'admin') ? ['type'=>"button", 'value'=>"Add Driver", 'class'=>"btn btn-primary mb-3", 'id'=>"add-driver-button"] : [];
                break;
            case 'Vehicles': 
                return ['type'=>"button", 'value'=>"Add Vehicle", 'class'=>"btn btn-primary mb-3", 'id'=>"add-vehicle-button"];
                break;         
            default:
                return [];
                break;
        }
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
