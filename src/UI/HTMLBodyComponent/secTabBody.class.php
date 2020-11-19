<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\CompositeBuilder;

class secTabBody extends HTMLBodyComponent
{
    private array $tabids;
    private array $subTabContents;
    private CompositeBuilder $compositeBuilder;

    public function __construct(array $tabids, array $subTabContents)
    {
        $this->tabids = $tabids;
        $this->subTabContents = $subTabContents;
        $this->compositeBuilder = new CompositeBuilder();
    }

    public function create(): void
    {
        $i = 0;
        $tabComList = [];
        foreach ($this->subTabContents as $tab) {

            if ($i == 0) {
                $this->compositeBuilder
                    ->createComposite('div', ['class' => "tab-pane secondary-tab fade active show", 'id' => $this->tabids[$i] . 'SecTab', 'role' => 'tabpanel']);
            } else {
                $this->compositeBuilder
                    ->createComposite('div', ['class' => "tab-pane secondary-tab fade", 'id' => $this->tabids[$i] . 'SecTab', 'role' => 'tabpanel']);
            }
            $tab->create();
            $tabCom = $this->compositeBuilder
                ->addToContent($this->getButton($this->tabids[$i]))
                ->addToContent($tab->getComponent())
                ->getComposite();
            array_push($tabComList, $tabCom);
            $i++;
        }
        $this->bodyComponent = $this->compositeBuilder
            ->createComposite('div', ['class' => 'container-fluid'])
            ->composite()
            ->createComposite('div', ['class' => 'tab-content'])
            ->addArrayToContent($tabComList)
            ->get()
            ->getComposite();
    }

    private function getButton($tabid): \UI\Builder\HTMLComponent
    {
        $buttonBuilder = new CompositeBuilder();
        switch ($tabid) {
            case 'Employees':
                $button = $buttonBuilder
                    ->createComposite()
                    ->composite()
                    ->createComposite('button', ['type' => "button", 'value' => "Add Employee", 'class' => "float-button p-3 mb-4", 'id' => "AddEmployeeButton", "data-title" => "New Employee"])
                    ->addElement('i', ['class' => "fa fa-plus float-icon", 'style' => "font-size:40px;color:white"])
                    ->get()
                    ->getComposite();
                return $button;
                break;
            case 'Drivers':
                if ($_SESSION['position'] == 'admin') {
                    $button = $buttonBuilder
                        ->createComposite()
                        ->composite()
                        ->createComposite('button', ['type' => "button", 'value' => "Add Driver", 'class' => "float-button p-3 mb-4", 'id' => "AddDriverButton", "data-title" => "New Driver"])
                        ->addElement('i', ['class' => "fa fa-plus float-icon", 'style' => "font-size:40px;color:white"])
                        ->get()
                        ->getComposite();
                } else {
                    $button = $buttonBuilder->createComposite()->getComposite();
                }
                return $button;
                break;
            case 'Vehicles':
                $button = $buttonBuilder
                    ->createComposite()
                    ->composite()
                    ->createComposite('button', ['type' => "button", 'value' => "Add Vehicle", 'class' => "float-button p-3 mb-4", 'id' => "AddVehicleButton", "data-title" => "New Vehicle"])
                    ->addElement('i', ['class' => "fa fa-plus float-icon", 'style' => "font-size:40px;color:white"])
                    ->get()
                    ->getComposite();
                return $button;
                break;
            default:
                $button = $buttonBuilder->createComposite()->getComposite();
                return $button;
                break;
        }
    }
}
