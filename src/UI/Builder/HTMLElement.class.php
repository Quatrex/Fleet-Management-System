<?php

namespace UI\Builder;

class HTMLElement extends HTMLComponent
{
    /**
     * Add array of strings to content
     * 
     * @param array $components
     * 
     */
    public function addToContent(array $components): void
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
            echo $content;
        }
        echo '</' . $this->tag . '>';
    }
}
