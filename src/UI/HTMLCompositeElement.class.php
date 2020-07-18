<?php

namespace UI;

class HTMLCompositeElement extends HTMLComponent
{
    public function addToContent($components): void
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
            $content->show();
        }
        echo '</' . $this->tag . '>';
    }

    // public function wrapWith(HTMLElement $wrapper, int $count = null)
    // {
    //     $count == null ? $count = sizeof(($this->composite_content)) : $count = $count;
    //     $wrapperContent = [];
    //     for ($x = 1; $x <= $count; $x++) {
    //         array_push($wrapperContent, array_pop($this->composite_content));
    //     }
    //     $wrapper->wrapElement(array_reverse($wrapperContent));
    //     array_push($this->composite_content, $wrapper);
    // }

    // private function format()
    // {
    //     $contentText = [];
    //     foreach ($this->composite_content as $composite) {
    //         array_push($contentText, $composite->getElement());
    //     }
    //     $this->composite->setContent(join($contentText, ''));
    // }
}
