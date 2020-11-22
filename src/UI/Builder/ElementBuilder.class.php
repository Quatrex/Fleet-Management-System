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

    /**
     * Returns HTML Element build by the builder
     * 
     * @return HTMLElement
     */
    public function getElement(): HTMLElement
    {
        return $this->element;
    }

    /**
     * Create HTML element 
     * 
     * @param string $tag
     * @param array $attributes ['Field' => 'Value']
     * @param array $content
     * 
     * @return ElementBuilder
     */
    public function createElement(string $tag, array $attributes=[],$content=[]): ElementBuilder
    {
        $this->element = new HTMLElement($tag);
        $this->element->addAttributes($attributes);
        $this->element->addToContent($content);
        return $this;
    }

    /**
     * Shows the composite element
     */
    public function show(): void
    {
        $this->element->show();
    }
}
