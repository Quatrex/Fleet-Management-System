<?php

namespace UI;

class HTMLElement extends HTMLComponent
{

    public function addToContent(array $components): void
    {
        $this->contents=array_merge($this->contents, $components);
    }

    public function show(): void
    {
        echo '<' . $this->tag;
        foreach ($this->attributes as $attribute => $value) {
            echo ' ' . $attribute . "='" . $value . "'";
        }
        echo '>';
        foreach ($this->contents as $content) {
            echo $content;
        }
        echo '</' . $this->tag . '>';
    }
    // public function wrapElement(array $elements)
    // {
    //     $this->content = '';
    //     foreach ($elements as $element) {
    //         $element->getElement() != null ? $this->content .= $element->getElement() : $this->content .= '';
    //     }
    // }
}
