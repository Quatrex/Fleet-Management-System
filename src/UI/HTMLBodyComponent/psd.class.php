<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\CompositeBuilder;

class Psd extends HTMLBodyComponent
{
    private array $navList;
    private CompositeBuilder $compositeBuilder;

    public function __construct(array $navList)
    {
        $this->navList = $navList;
        $this->compositeBuilder = new CompositeBuilder();
    }

    public function create(): void
    {
        $navContentList = [];
        $j = 0;
        foreach ($this->navList as $mainNav => $secondNavList) {

            if ($j == 0) {
                $tabClass = 'main-navi main-nav-link hvrcenter active';
            } else {
                $tabClass = 'main-navi main-nav-link hvrcenter';
            }
            $j++;
            $liList = [];
            for ($i = 0; $i < sizeof($secondNavList); $i++) {
                $liComposite = $this->compositeBuilder
                    ->createComposite('li', ['class' => "secondary-nav"])
                    ->addElement('a', ['class' => "nav-link hvrcenter", 'id' => str_replace(' ', '', $secondNavList[$i]) . 'SecLinkResponsive'], [$secondNavList[$i]])
                    ->getComposite();
                array_push($liList, $liComposite);
            }
            $navComposite = $this->compositeBuilder
                ->createComposite('div', ['class' => "nav-content_child_3", 'id' => str_replace(' ', '', $mainNav) . 'SecTabResponsive'])
                ->addElement('a', ['class' => $tabClass, 'id' =>  str_replace(' ', '', $mainNav) . 'MainLinkResponsive'], [$mainNav])
                ->composite()
                ->createComposite('ul', ['class' => "hidden-list", 'id' =>  str_replace(' ', '', $mainNav) . 'SecList'])
                ->addArrayToContent($liList)
                ->get()
                ->getComposite();
            array_push($navContentList, $navComposite);
        }
        $this->bodyComponent = $this->compositeBuilder
            ->createComposite('div', ['class' => 'psd'])
            ->composite()
            ->createComposite('div', ['class' => 'psd_child_1'])
            ->composite()
            ->createComposite('div', ['class' => 'css-vurnku', "style" => "box-sizing: border-box; margin: 0; min-width: 0;"])
            ->composite()
            ->createComposite('button', ['class' => "psd_child_2", 'id' => "close-button"])
            ->composite()
            ->createComposite('div', ['class' => "psd_child_3",'id'=>''])
            ->composite()
            ->createComposite()
            ->addElement('span', ['class' => "psd_child_4"], ['Close Menu'])
            ->get()
            ->get()
            ->get()
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "nav-content"])
            ->composite()
            ->createComposite('div', ['class' => "nav-content_child_1"])
            ->composite()
            ->createComposite('div', ['class' => "nav-content_child_2"])
            ->addArrayToContent($navContentList)
            ->get()
            ->get()
            ->get()
            ->getComposite();
    }
}
