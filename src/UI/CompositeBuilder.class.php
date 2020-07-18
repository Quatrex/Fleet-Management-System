<?php

namespace UI;

class CompositeBuilder
{
    protected HTMLCompositeElement $compositeElement;
    protected ?CompositeBuilder $parent;

    public function __construct(CompositeBuilder $parent = null)
    {
        $this->parent = $parent;
    }

    public function createComposite(string $tag,  array $attributes = []): CompositeBuilder
    {
        $this->compositeElement = new HTMLCompositeElement($tag);
        $this->compositeElement->addAttributes($attributes);
        return $this;
    }

    public function composite(): CompositeBuilder
    {
        return new CompositeBuilder($this);
    }

    public function get(): CompositeBuilder
    {
        $this->parent->addToContent($this->compositeElement);
        return $this->parent;
    }

    public function addToContent(HTMLComponent $component): CompositeBuilder
    {
        $this->compositeElement->addToContent([$component]);
        return $this;
    }

    public function getComposite(): HTMLCompositeElement
    {
        return $this->compositeElement;
    }

    public function addAttributes(array $attributes): CompositeBuilder
    {
        $this->compositeElement->addAttributes($attributes);
        return $this;
    }

    public function addElement(string $tag, array $attributes = [], array $content = []): CompositeBuilder
    {
        $element = new HTMLElement($tag);
        $element->addAttributes($attributes);
        $element->addToContent($content);
        $this->compositeElement->addToContent([$element]);
        return $this;
    }
    public function show(): void
    {
        $this->compositeElement->show();
    }
}
