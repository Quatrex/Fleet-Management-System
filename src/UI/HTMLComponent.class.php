<?php

namespace UI;

abstract class HTMLComponent
{

    protected $tag;
    protected $attributes;
    protected $contents;

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
