<?php

namespace UI\Builder;

class HTMLCompositeElement extends HTMLComponent
{
    /**
     * Add array of HTML Components to content
     * 
     * @param array $components
     * 
     */
    public function addToContent($components): void
    {
        $this->contents=array_merge($this->contents, $components);
    }

    /**
     * Shows the composite element
     */
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
