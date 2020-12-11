<?php

namespace UI\Builder;

class CompositeBuilder
{
    protected HTMLCompositeElement $compositeElement;
    protected ?CompositeBuilder $parent;

    public function __construct(CompositeBuilder $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * Create new composite element
     * 
     * @param string $tag
     * @param array $attributes ['Field' => 'Value']
     * 
     * @return CompositeBuilder
     */
    public function createComposite(string $tag = 'div',  array $attributes = []): CompositeBuilder
    {
        $this->compositeElement = new HTMLCompositeElement($tag);
        $this->compositeElement->addAttributes($attributes);
        return $this;
    }

    /**
     * Create new composite builder as a child of previous
     * and returns it
     * 
     * @return CompositeBuilder
     */
    public function composite(): CompositeBuilder
    {
        return new CompositeBuilder($this);
    }

    /**
     * Returns back to the parent
     * 
     * @return CompositeBuilder
     */
    public function get(): CompositeBuilder
    {
        $this->parent->addToContent($this->compositeElement);
        return $this->parent;
    }

    /**
     * Add HTML component to the content
     * 
     * @param HTMLComponent $component
     * 
     * @return CompositeBuilder
     */
    public function addToContent(HTMLComponent $component): CompositeBuilder
    {
        $this->compositeElement->addToContent([$component]);
        return $this;
    }

    /**
     * Add array of HTML components to the content
     * 
     * @param array HTMLComponeet $components
     * 
     * @return CompositeBuilder
     */
    public function addArrayToContent(array $components): CompositeBuilder
    {
        $this->compositeElement->addToContent($components);
        return $this;
    }

    /**
     * Returns HTML Composite build by the builder
     * 
     * @return HTMLCompositeElement
     */
    public function getComposite(): HTMLCompositeElement
    {
        return $this->compositeElement;
    }

    /**
     * Insert attributes to composite element
     * 
     * @param array $attributes ['Field' => 'Value']
     * 
     * @return CompositeBuilder
     */
    public function addAttributes(array $attributes): CompositeBuilder
    {
        $this->compositeElement->addAttributes($attributes);
        return $this;
    }

    /**
     * Create and add HTML element to the composite element's content
     * 
     * @param string $tag
     * @param array $attributes ['Field' => 'Value']
     * @param array $content
     * 
     * @return CompositeBuilder
     */
    public function addElement(string $tag, array $attributes = [], array $content = []): CompositeBuilder
    {
        $element = new HTMLElement($tag);
        $element->addAttributes($attributes);
        $element->addToContent($content);
        $this->compositeElement->addToContent([$element]);
        return $this;
    }

    /**
     * Shows the composite element
     */
    public function show(): void
    {
        $this->compositeElement->show();
    }

}
