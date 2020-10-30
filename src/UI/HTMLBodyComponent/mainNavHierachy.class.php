<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\CompositeBuilder;

class MainNavHierachy extends HTMLBodyComponent
{
    private array $tabids;
    private array $secNavList = [];
    private array $secTabs = [];
    private CompositeBuilder $compositeBuilder;

    public function __construct(array $tabids, array $secNavList, array $secTabs)
    {
        $this->tabids = $tabids;
        $this->secNavList = $secNavList;
        $this->secTabs = $secTabs;
        $this->compositeBuilder = new CompositeBuilder();
    }

    public function create(): void
    {
        $mainTabComList = [];
        for ($i = 0; $i < sizeof($this->secNavList); $i++) {

            if ($i == 0) {
                $tabClass = 'main-tabs tab-pane fade active show';
            } else {
                $tabClass = 'main-tabs tab-pane fade';
            }
            if ($this->tabids == []) {
                $this->compositeBuilder
                    ->createComposite('div', ['class' => $tabClass, 'role' => 'tabpanel']);
            } else {
                $this->compositeBuilder
                    ->createComposite('div', ['class' => $tabClass, 'id' => $this->tabids[$i] . 'MainTab', 'role' => 'tabpanel'])
                    ->addToContent($this->getButtonForSecTab($this->tabids[$i]));
            }
            $this->secNavList[$i]->create();
            $this->secTabs[$i]->create();
            $tabCom = $this->compositeBuilder
                ->addArrayToContent([$this->secNavList[$i]->getComponent(), $this->secTabs[$i]->getComponent()])
                ->getComposite();
            array_push($mainTabComList, $tabCom);
        }
        $this->bodyComponent = $this->compositeBuilder
            ->createComposite('div', ['class' => 'tab-content main-tab-pane'])
            ->composite()
            ->createComposite('div', ['class' => 'tab-content'])
            ->addArrayToContent($mainTabComList)
            ->get()
            ->getComposite();
    }

    private function getButtonForSecTab(string $navId)
    {
        $buttonBuilder = new CompositeBuilder();
        switch ($navId) {
            case 'MyRequests':
                $button = $buttonBuilder
                    ->createComposite()
                    ->composite()
                    ->createComposite('button', ['type' => 'button', 'value' => 'New Request', 'class' => "float-button p-3 mb-4", "id" => "NewRequestButton", "data-title" => "New Request"])
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
