<?php

namespace UI\Builder;

class ElementBuilder
{
    private static ?ElementBuilder $instance = null;
    private HTMLElement $element;

    private function __construct()
    {
    }

    public static function getInstance(): ElementBuilder
    {
        if (self::$instance == null)
            self::$instance = new self;
        return self::$instance;
        return new self;
    }

    public function getElement(): HTMLElement
    {
        return $this->element;
    }

    public function createElement(string $tag, array $attributes=[],$content=[]): ElementBuilder
    {
        $this->element = new HTMLElement($tag);
        $this->element->addAttributes($attributes);
        $this->element->addToContent($content);
        return $this;
    }

    public function show(): void
    {
        $this->element->show();
    }
}
