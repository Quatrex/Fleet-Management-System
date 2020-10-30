<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\CompositeBuilder;
use UI\Builder\ElementBuilder;

class SecNavBar extends HTMLBodyComponent
{
    private string $id;
    private array $navList;
    private CompositeBuilder $compositeBuilder;
    private ElementBuilder $elementBuilder;

    public function __construct(string $id, array $navList)
    {
        $this->id = $id;
        $this->navList = $navList;
        $this->compositeBuilder = new CompositeBuilder();
        $this->elementBuilder = ElementBuilder::getInstance();
    }

    public function create(): void
    {
        $i = 0;
        $navComList = [];
        foreach ($this->navList as $nav) {

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
        $this->bodyComponent =
            $this->compositeBuilder
            ->createComposite('div', ['class' => 'secondary-nav-bar'])
            ->composite()
            ->createComposite('nav', ['class' => 'pt-3 mb-3'])
            ->composite()
            ->createComposite('div', ['class' => 'nav nav-pills justify-content-start ml-5', 'id' => $this->id])
            ->addArrayToContent($navComList)
            ->get()
            ->get()
            ->getComposite();
    }
}
