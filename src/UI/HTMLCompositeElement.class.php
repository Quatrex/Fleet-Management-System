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
}
