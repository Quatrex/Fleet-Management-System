<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\CompositeBuilder;

class Employees extends Tab
{
    private array $employees;
    private CompositeBuilder $compositeBuilder;

    public function __construct(array $employees)
    {
        parent::__construct();
        $this->employees = $employees;
        $this->compositeBuilder = new CompositeBuilder();
    }

    public function create(): void{
        $employeeCards = [];
        foreach ($this->employees as $employee) {
            $employeeCard = $this->compositeBuilder
                ->createComposite('div', ['class' => 'col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description', 'id' => 'employeeCard_' . htmlentities($employee->getField('empID'))])
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
        $this->bodyComponent = $this->compositeBuilder
            ->createComposite('div', ['class' => 'card', 'id' => 'employeeContainer'])
            ->composite()
            ->createComposite('div', ['class' => "card-header text-white py-0"])
            ->addToContent($this->createMySearchBar('Employee ', ['First Name', 'Last Name', 'Designation', 'Position', 'EmployeeID']))
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
    }
}