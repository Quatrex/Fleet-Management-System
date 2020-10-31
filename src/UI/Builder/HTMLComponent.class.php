<?php

namespace UI\Builder;

abstract class HTMLComponent
{

    protected string $tag;
    protected array $attributes;
    protected array $contents;

    public function __construct(string $tag = 'div')
    {
        $this->tag = $tag;
        $this->attributes = [];
        $this->contents = [];
    }

    public function addAttributes(array $attributes):void
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    abstract public function addToContent(array $components): void;

    abstract public function show():void;
}
