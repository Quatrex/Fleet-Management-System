<?php

namespace UI\HTMLBodyComponent;

abstract class Tab extends HTMLBodyComponent
{
    protected function createMySearchBar(string $header, array $dropDownList)
    {
        $searchBar = new SearchBar($header, $dropDownList);
        return $searchBar->getComponent();
    }
}
