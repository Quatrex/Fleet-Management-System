<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\ElementBuilder;
use UI\Builder\CompositeBuilder;

class SearchBar extends HTMLBodyComponent
{
    private string $header;
    private array $dropDownList;

    public function __construct(string $header, array $dropDownList)
    {
        $this->header=$header;
        $this->dropDownList = $dropDownList;
    }

    /**
     * @inheritDoc
     */
    public function create(): void
    {
        $searchbarBuilder = new CompositeBuilder();
        $this->bodyComponent = $searchbarBuilder
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
            ->addElement('input', ['type' => "text", 'class' => "form-control pr-2", 'id' => lcfirst(str_replace(' ', '', $this->header)) . "Container_SearchInput", 'placeholder' => "Search", 'style' => "border-radius: 0px!important;"])
            ->composite()
            ->createComposite('span', ['class' => "form-clear searchTabButton d-none mr-2", 'id' => "Cancel_Confirm_button"])
            ->addElement('i', ['class' => "material-icons"], ['clear'])
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "col-sm-3"])
            ->composite()
            ->createComposite('select', ['class' => "custom-select mr-sm-2", 'data-field' => "Search", "name" => "searchColumn", 'style' => "border-radius: 0px!important;"])
            ->addArrayToContent($this->getDropDownMenu('search', $this->header, $this->dropDownList))
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'col-sm-3'])
            ->addElement('input', ['type' => "button", 'class' => "btn searchTabButton", 'id' => "Search_Confirm_" . lcfirst(str_replace(' ', '', $this->header)), 'value' => "Search"])
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
            ->addArrayToContent($this->getDropDownMenu('sort', $this->header, $this->dropDownList))
            ->get()
            ->get()
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "col-sm-4 ml-2 my-auto"])
            ->composite()
            ->createComposite('button', ['type' => "button", 'class' => "btn btn btn-outline-dark searchTabButton searchTabSortButton selected-sort mr-2", 'id' => 'Desc_' . str_replace(' ', '', lcfirst($this->header)) . 'Container'])
            ->composite()
            ->createComposite('svg', ['width' => "1.3em", 'height' => "1.3em", 'viewBox' => "0 0 16 16", 'class' => "bi bi-sort-down-alt", 'fill' => "currentColor", 'xmlns' => "http://www.w3.org/2000/svg"])
            ->addElement('path', ['fill-rule' => "evenodd", 'd' => "M3 3a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-1 0v-10A.5.5 0 0 1 3 3z"])
            ->addElement('path', ['fill-rule' => "evenodd", 'd' => "M5.354 11.146a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L3 12.793l1.646-1.647a.5.5 0 0 1 .708 0zM7 6.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 0-1h-5a.5.5 0 0 0-.5.5zm0 3a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm0-9a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5z"])
            ->get()
            ->get()
            ->composite()
            ->createComposite('button', ['type' => "button", 'class' => "btn btn btn-outline-dark searchTabButton searchTabSortButton", 'id' => 'Asc_' . str_replace(' ', '', lcfirst($this->header)) . 'Container'])
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
                $dropdown = ElementBuilder::getInstance()->createElement('option', ['value' => str_replace(' ', '', $item), 'selected' => ''], [$item])->getElement();
            } else {
                $dropdown = ElementBuilder::getInstance()->createElement('option', ['value' => str_replace(' ', '', $item)], [$item])->getElement();
            }
            array_push($dropDownMenu, $dropdown);
            $i++;
        }
        return $dropDownMenu;
    }
}