<?php

namespace UI;

use Employee\Employee;

class HTMLBuilder
{
    private static ?HTMLBuilder $instance = null;
    private CompositeBuilder $compositeBuilder;
    private ElementBuilder $elementBuilder;
    private array $contents = [];
    private array $secNavList = [];
    private array $secTabs = [];
    private array $subTabContents = [];

    private function __construct()
    {
        $this->compositeBuilder = new CompositeBuilder();
        $this->elementBuilder = ElementBuilder::getInstance();
    }

    public static function getInstance(): HTMLBuilder
    {
        if (self::$instance == null)
            self::$instance = new self;
        return self::$instance;
    }

    public function createMainNavBar(Employee $employee, array $navList = []): HTMLBuilder
    {
        $i = 0;
        $navComList = [];
        foreach ($navList as $nav) {

            if ($i == 0) {
                $this->compositeBuilder
                    ->createComposite('li', ['class' => "nav-item hvrcenter active", 'id' => str_replace(' ', '', $nav) . 'MainLink', 'data-toggle' => str_replace(' ', '', $nav)]);
            } else {
                $this->compositeBuilder
                    ->createComposite('li', ['class' => "nav-item hvrcenter mr-2", 'id' => str_replace(' ', '', $nav) . 'MainLink', 'data-toggle' => str_replace(' ', '', $nav)]);
            }

            $navCom = $this->compositeBuilder
                ->addElement('a', ['class' => 'nav-link'], [$nav])
                ->getComposite();
            array_push($navComList, $navCom);
            $i++;
        }
        $mainNavBar =
            $this->compositeBuilder
            ->createComposite('nav', ['class' => "main-nav navbar navbar-expand-md navbar-dark py-0"])
            ->composite()
            ->createComposite('a', ['class' => "navbar-brand mr-auto", 'href' => "#"])
            ->addElement('img', ['src' => "../images/national-logo.png", 'class' => "logo img-fluid"])
            ->get()
            ->composite()
            ->createComposite('button', ['class' => "navbar-toggler my-2", 'type' => "button", 'data-toggle' => "collapse", 'data-target' => "#mainnavbarContent"])
            ->addElement('span', ['class' => "navbar-toggler-icon"])
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "collapse tab-info navbar-collapse", 'id' => "mainnavbarContent"])
            ->composite()
            ->createComposite('ul', ['class' => 'navbar-nav ml-auto', 'id' => 'mainNavBarContainer'])
            ->addArrayToContent($navComList)
            ->composite()
            ->createComposite('li', ['class' => 'nav-item dropdown'])
            ->composite()
            ->createComposite('a', ['class' => "nav-link dropdown-toggle", 'id' => "navbarDropdownMenuLink-55", 'data-toggle' => "dropdown", 'aria-haspopup' => "true", 'aria-expanded' => "false"])
            ->addElement('img', ['src' => $employee->getField('profilePicturePath') != null ? "../images/profilePictures/" . $employee->getField('profilePicturePath') : "../images/default-user-image.png", 'class' => "rounded-circle user-image mt-2 ProfilePicture", 'style' => "height:35px;"])
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "dropdown-menu dropdown-menu-lg-right dropdown-secondary profile-dropdown", 'aria-labelledby' => "navbarDropdownMenuLink-55", 'style' => "position:absolute;"])
            ->composite()
            ->createComposite('div', ['class' => "user-dropdown dropdown-content"])
            ->addElement('img', ['class' => 'ProfilePicture', 'src' => $employee->getField('profilePicturePath') != null ? "../images/profilePictures/" . $employee->getField('profilePicturePath') : "../images/default-user-image.png"])
            ->composite()
            ->createComposite('div', ['class' => 'container'])
            ->addElement('p')
            ->addElement('p', ['class' => "name-profile-dd"])
            ->addElement('p', ['class' => "name-profile-dd"])
            ->addElement('p', ['class' => "mail-profile-dd"])
            ->addElement('p')
            ->addElement('button', ['type' => "button", 'class' => "btn btn-light mx-auto my-2", 'id' => "UserProfileEditButton"], ['Edit account info'])
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "footer-profile"])
            ->addElement('a', ['type' => "button", 'class' => "btn btn-light", 'href' => "../func/logout.php"], ['Sign out'])
            ->get()
            ->get()
            ->get()
            ->get()
            ->get()
            ->getComposite();
        array_push($this->contents, $mainNavBar);
        return $this;
    }

    public function createSecondaryNavBar(string $id, array $navList): HTMLBuilder
    {
        $i = 0;
        $navComList = [];
        foreach ($navList as $nav) {

            if ($i == 0) {
                $this->elementBuilder
                    ->createElement('a', ['class' => "nav-item nav-link active hvrcenter", 'data-toggle' => "tab", 'id' => str_replace(' ', '', $nav) . 'SecLink', 'href' => '#' . str_replace(' ', '', $nav)], [strpos($nav, 'History') ? 'History' : $nav]);
            } else {
                $this->elementBuilder
                    ->createElement('a', ['class' => "nav-item nav-link hvrcenter", 'data-toggle' => "tab", 'id' => str_replace(' ', '', $nav) . 'SecLink', 'href' => '#' . str_replace(' ', '', $nav)], [strpos($nav, 'History') ? 'History' : $nav]);
            }

            $navCom = $this->elementBuilder->getElement();
            array_push($navComList, $navCom);
            $i++;
        }
        $secNavBar =
            $this->compositeBuilder
            ->createComposite('div', ['class' => 'secondary-nav-bar'])
            ->composite()
            ->createComposite('nav', ['class' => 'pt-3 mb-3'])
            ->composite()
            ->createComposite('div', ['class' => 'nav nav-pills justify-content-start ml-5', 'id' => $id])
            ->addArrayToContent($navComList)
            ->get()
            ->get()
            ->getComposite();
        array_push($this->secNavList, $secNavBar);
        return $this;
    }

    public function myRequests(array $requests, string $state, $header = ''): HTMLBuilder
    {
        $i = 0;
        $requestElements = [];
        foreach ($requests as $request) {
            $requestElement = $this->compositeBuilder
                ->createComposite('div', ['class' => 'card request-card detail-description', 'id' => strtolower($state) . 'RequestsCard_' . htmlentities($request->getField('requestID')), 'style' => 'z-index:2;'])
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
        $card = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card', 'id' => strtolower($state) . 'RequestsContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header bg-dark text-white py-0"])
            ->addToContent($this->createMySearchBar($header, ['Created Date', 'Pick Location', 'Drop Location', 'Time Of Trip', 'Date Of Trip', 'Purpose', 'State']))
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'card-body pb-3'])
            ->addArrayToContent($requestElements)
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "row d-flex justify-content-center"])
            ->addElement('button', ['class' => "btn w-100 btn-light load-more mb-3 d-none mr-5 ml-5", "id" => strtolower($state) . 'RequestsContainer_LoadMore'], ['Load More'])
            ->get()
            ->getComposite();
        array_push($this->subTabContents, $card);
        return $this;
    }

    public function awaitingRequests(array $requests, string $state, string $header): HTMLBuilder
    {
        $i = 0;
        $requestElements = [];
        foreach ($requests as $request) {
            $requestElement = $this->compositeBuilder
                ->createComposite('div', ['class' => 'card request-card detail-description', 'id' => strtolower($state) . 'AwaitingRequestCard_' . htmlentities($request->getField('requestID')), 'style' => 'z-index:2;'])
                ->composite()
                ->createComposite('div', ['class' => 'description'])
                //->addElement('span',['class'=>'request-id','id'=> strtolower($state) . '-request-' . $i],['Requset id: ' . htmlentities($request->getField('requestID'))])
                ->addElement('h1', ['class' => 'card-title'], ['For: ' . htmlentities($request->getField('purpose'))])
                ->addElement('h2', ['class' => 'card-title'], ['By: ' . htmlentities(($request->getField('requester'))->getField('firstName') . ' ' . ($request->getField('requester'))->getField('lastName'))])
                ->addElement('h2', ['class' => 'card-title hidden-details'], ['Designation: ' . htmlentities(($request->getField('requester'))->getField('designation'))])
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
        $card = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card', 'id' => strtolower($state) . 'AwaitingRequestContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header bg-dark text-white py-0"])
            ->addToContent($this->createMySearchBar(strtolower($state) . 'AwaitingRequest', ['Created Date', 'Pickup Location', 'Drop Location', 'Time of Trip', 'Date of Trip', 'Purpose', 'State']))
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'card-body pb-3'])
            ->addArrayToContent($requestElements)
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "row d-flex justify-content-center"])
            ->addElement('button', ['class' => "btn w-100 btn-light load-more mb-3 d-none mr-5 ml-5", "id" => strtolower($state) . 'AwaitingRequestContainer_LoadMore'], ['Load More'])
            ->get()
            ->getComposite();
        array_push($this->subTabContents, $card);
        return $this;
    }

    public function drivers(array $drivers): HTMLBuilder
    {
        $driverCards = [];
        foreach ($drivers as $driver) {
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
        $card = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card', 'id' => 'driverContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header bg-dark text-white py-0"])
            ->addToContent($this->createMySearchBar('Drivers', ['First Name', 'Last Name', 'Driver ID']))
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
        array_push($this->subTabContents, $card);
        return $this;
    }

    public function vehicles(array $vehicles): HTMLBuilder
    {
        $vehicleCards = [];
        foreach ($vehicles as $vehicle) {
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
        $card = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card mt-5', 'id' => 'vehiclesContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header bg-dark text-white py-0"])
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
        array_push($this->subTabContents, $card);
        return $this;
    }

    public function employees(array $employees): HTMLBuilder
    {
        $employeeCards = [];
        foreach ($employees as $employee) {
            $employeeCard = $this->compositeBuilder
                ->createComposite('div', ['class' => 'col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description', 'id' => 'employeeContainer_' . htmlentities($employee->getField('empID'))])
                ->composite()
                ->createComposite('div', ['class' => 'card text-center', 'style' => 'width: 15rem;'])
                ->addElement('img', ['class' => "card-img-top rounded-circle user-image mt-2", 'src' => $employee->getField('profilePicturePath') != null ? "../images/profilePictures/" . $employee->getField('profilePicturePath') : "../images/default-user-image.png", 'alt' => "Driver Image"])
                ->composite()
                ->createComposite('div', ['class' => 'card-body'])
                ->addElement('h5', ['class' => 'card-title FirstName LastName'], [$employee->getField('firstName') . ' ' . $employee->getField('lastName')])
                ->addElement('h6', ['class' => 'card-subtitle mb-2 text-muted Designation'], ['Designation: ' . $employee->getField('designation')])
                ->addElement('h6', ['class' => 'card-subtitle mb-2 text-muted Position'], ['Role: ' . $employee->getField('position')])
                ->addElement('p', ['class' => 'card-text Email'], [$employee->getField('email')])
                ->get()
                ->get()
                ->getComposite();
            array_push($employeeCards, $employeeCard);
        }
        $card = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card', 'id' => 'employeeContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header bg-dark text-white py-0"])
            ->addToContent($this->createMySearchBar('Employees', ['Employee ID', 'First Name', 'Last Name', 'Designation', 'Position']))
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'card-body row pb-3'])
            ->addArrayToContent($employeeCards)
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "row d-flex justify-content-center"])
            ->addElement('button', ['class' => "btn w-100 btn-light load-more mb-3 d-none mr-5 ml-5", "id" => 'employeeContainer_LoadMore'], ['Load More'])
            ->get()
            ->getComposite();
        array_push($this->subTabContents, $card);
        return $this;
    }

    public function buildSecTabBody($tabids): HTMLBuilder
    {
        $i = 0;
        $tabComList = [];
        foreach ($this->subTabContents as $tab) {

            if ($i == 0) {
                $this->compositeBuilder
                    ->createComposite('div', ['class' => "tab-pane secondary-tab fade active show", 'id' => $tabids[$i] . 'SecTab', 'role' => 'tabpanel']);
            } else {
                $this->compositeBuilder
                    ->createComposite('div', ['class' => "tab-pane secondary-tab fade", 'id' => $tabids[$i] . 'SecTab', 'role' => 'tabpanel']);
            }

            $tabCom = $this->compositeBuilder
                ->addToContent($this->getButton($tabids[$i]))
                ->addToContent($tab)
                ->getComposite();
            array_push($tabComList, $tabCom);
            $i++;
        }
        $subBody = $this->compositeBuilder
            ->createComposite('div', ['class' => 'container-fluid'])
            ->composite()
            ->createComposite('div', ['class' => 'tab-content'])
            ->addArrayToContent($tabComList)
            ->get()
            ->getComposite();
        array_push($this->secTabs, $subBody);
        $this->subTabContents = [];
        return $this;
    }

    public function createMainNavHierachy($tabids = []): HTMLBuilder
    {
        $mainTabComList = [];
        for ($i = 0; $i < sizeof($this->secNavList); $i++) {

            if ($i == 0) {
                $tabClass = 'main-tabs tab-pane fade active show';
            } else {
                $tabClass = 'main-tabs tab-pane fade';
            }
            if ($tabids == []) {
                $this->compositeBuilder
                    ->createComposite('div', ['class' => $tabClass, 'role' => 'tabpanel']);
            } else {
                $this->compositeBuilder
                    ->createComposite('div', ['class' => $tabClass, 'id' => $tabids[$i] . 'MainTab', 'role' => 'tabpanel']);
            }

            $tabCom = $this->compositeBuilder
                ->addArrayToContent([$this->secNavList[$i], $this->secTabs[$i]])
                ->getComposite();
            array_push($mainTabComList, $tabCom);
        }
        $mainBody = $this->compositeBuilder
            ->createComposite('div', ['class' => 'tab-content main-tab-pane'])
            ->composite()
            ->createComposite('div', ['class' => 'tab-content'])
            ->addArrayToContent($mainTabComList)
            ->get()
            ->getComposite();
        array_push($this->contents, $mainBody);
        return $this;
    }

    public function show()
    {
        foreach ($this->contents as $content) {
            $content->show();
        }
    }

    private function createMySearchBar(string $header, array $dropDownList)
    {
        $searchbarBuilder = new CompositeBuilder();
        $searchBar = $searchbarBuilder
            ->createComposite('div', ['class' => 'search-container pt-3'])
            ->composite()
            ->createComposite('div', ['class' => 'row mt-2 pt-2 ml-2'])
            ->composite()
            ->createComposite('div', ['class' => "col-sm-6 mb-3"])
            ->composite()
            ->createComposite('div', ['class' => "input-group"])
            ->composite()
            ->createComposite('div', ['class' => 'row w-100'])
            ->composite()
            ->createComposite('div', ['class' => 'col-sm-6 pr-0 form-group position-relative'])
            ->addElement('input', ['type' => "text", 'class' => "form-control pr-2", 'id' => lcfirst(str_replace(' ', '', $header)) . "Container_SearchInput", 'placeholder' => "Search", 'style' => "border-radius: 0px!important;"])
            ->composite()
            ->createComposite('span', ['class' => "form-clear searchTabButton d-none mr-2", 'id' => "Cancel_Confirm_button"])
            ->addElement('i', ['class' => "material-icons"], ['clear'])
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "col-sm-3"])
            ->composite()
            ->createComposite('select', ['class' => "custom-select mr-sm-2", 'data-field' => "Search", "name" => "searchColumn", 'style' => "border-radius: 0px!important;"])
            ->addArrayToContent($this->getDropDownMenu('search', $header, $dropDownList))
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'col-sm-3'])
            ->addElement('input', ['type' => "button", 'class' => "btn searchTabButton", 'id' => "Search_Confirm_" . lcfirst(str_replace(' ', '', $header)), 'value' => "Search"])
            ->get()
            ->get()
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "col-sm-5 ml-2"])
            ->composite()
            ->createComposite('div', ['class' => "row"])
            ->composite()
            ->createComposite('div', ['class' => "sm-8"])
            ->composite()
            ->createComposite('div', ['class' => 'row'])
            ->composite()
            ->createComposite('div', ['class' => 'col-sm-2 my-auto mr-1'])
            ->addElement('label', ['class' => 'mr-2'], ['Sort'])
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "col-sm-9"])
            ->composite()
            ->createComposite('select', ['class' => "custom-select mr-sm-2", 'data-field' => "Sort", "name" => "sortColumn"])
            ->addArrayToContent($this->getDropDownMenu('sort', $header, $dropDownList))
            ->get()
            ->get()
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "col-sm-4 ml-2 my-auto"])
            ->composite()
            ->createComposite('button', ['type' => "button", 'class' => "btn btn btn-outline-dark searchTabButton searchTabSortButton selected-sort mr-2", 'id' => 'Desc_' . str_replace(' ', '', lcfirst($header)) . 'Container'])
            ->composite()
            ->createComposite('svg', ['width' => "1.3em", 'height' => "1.3em", 'viewBox' => "0 0 16 16", 'class' => "bi bi-sort-down-alt", 'fill' => "currentColor", 'xmlns' => "http://www.w3.org/2000/svg"])
            ->addElement('path', ['fill-rule' => "evenodd", 'd' => "M3 3a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-1 0v-10A.5.5 0 0 1 3 3z"])
            ->addElement('path', ['fill-rule' => "evenodd", 'd' => "M5.354 11.146a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L3 12.793l1.646-1.647a.5.5 0 0 1 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z"])
            ->get()
            ->get()
            ->composite()
            ->createComposite('button', ['type' => "button", 'class' => "btn btn btn-outline-dark searchTabButton searchTabSortButton", 'id' => 'Asc_' . str_replace(' ', '', lcfirst($header)) . 'Container'])
            ->composite()
            ->createComposite('svg', ['width' => "1.3em", 'height' => "1.3em", 'viewBox' => "0 0 16 16", 'class' => "bi bi-sort-up-alt", 'fill' => "currentColor", 'xmlns' => "http://www.w3.org/2000/svg"])
            ->addElement('path', ['fill-rule' => "evenodd", 'd' => "M3 14a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-1 0v10a.5.5 0 0 0 .5.5z"])
            ->addElement('path', ['fill-rule' => "evenodd", 'd' => "M5.354 5.854a.5.5 0 0 0 0-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L3 4.207l1.646 1.647a.5.5 0 0 0 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z"])
            ->get()
            ->get()
            ->get()
            ->get()
            ->get()
            ->get()
            ->getComposite();
        return $searchBar;
    }

    private function getDropDownMenu(string $searchOrSort, string $header, array $itemList = [])
    {
        if ($searchOrSort == 'search') {
            array_unshift($itemList, "All");
        }
        $dropDownMenu = [];
        $i = 0;
        foreach ($itemList as $item) {
            if ($i == 0) {
                $dropdown = $this->elementBuilder->createElement('option', ['value' => str_replace(' ', '', $item), 'selected' => ''], [$item])->getElement();
            } else {
                $dropdown = $this->elementBuilder->createElement('option', ['value' => str_replace(' ', '', $item)], [$item])->getElement();
            }
            array_push($dropDownMenu, $dropdown);
            $i++;
        }
        return $dropDownMenu;
    }

    private function getButton($tabid):HTMLComponent
    {
        $buttonBuilder = new CompositeBuilder();
        switch ($tabid) {
            case 'PendingRequests':
                $button = $buttonBuilder
                    ->createComposite()
                    ->composite()
                    ->createComposite('button', ['type' => 'button', 'value' => 'New Request', 'class' => "float-button p-3 mb-4", "id" => "NewRequestButton"])
                    ->addElement('i', ['class' => "fa fa-plus float-icon", 'style' => "font-size:40px;color:white"])
                    ->get()
                    ->getComposite();
                return $button;
                break;
            case 'OngoingRequests':
                $button = $buttonBuilder
                    ->createComposite()
                    ->composite()
                    ->createComposite('button', ['type' => 'button', 'value' => 'New Request', 'class' => "float-button p-3 mb-4", "id" => "NewRequestButton"])
                    ->addElement('i', ['class' => "fa fa-plus float-icon", 'style' => "font-size:40px;color:white"])
                    ->get()
                    ->getComposite();
                return $button;
                break;
            case 'History':
                $button = $buttonBuilder
                    ->createComposite()
                    ->composite()
                    ->createComposite('button', ['type' => 'button', 'value' => 'New Request', 'class' => "float-button p-3 mb-4", "id" => "NewRequestButton"])
                    ->addElement('i', ['class' => "fa fa-plus float-icon", 'style' => "font-size:40px;color:white"])
                    ->get()
                    ->getComposite();
                return $button;
                break;
            case 'Employees':
                $button = $buttonBuilder
                    ->createComposite('button', ['type' => "button", 'value' => "Add Employee", 'class' => "btn btn-primary mb-3", 'id' => "AddEmployeeButton"])
                    ->getComposite();
                return $button;
                break;
            case 'Drivers':
                if ($_SESSION['position'] == 'admin') {
                    $button = $buttonBuilder
                        ->createComposite('button', ['type' => "button", 'value' => "Add Driver", 'class' => "btn btn-primary mb-3", 'id' => "AddDriverButton"])
                        ->getComposite();
                } else {
                    $button = $buttonBuilder->createComposite()->getComposite();
                }
                return $button;
                break;
            case 'Vehicles':
                $button = $buttonBuilder
                    ->createComposite('button', ['type' => "button", 'value' => "Add Vehicle", 'class' => "btn btn-primary mb-3", 'id' => "AddVehicleButton"])
                    ->getComposite();
                return $button;
                break;
            default:
                $button = $buttonBuilder->createComposite()->getComposite();
                return $button;
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
