<?php

namespace UI\HTMLBodyComponent;

use UI\Builder\HTMLComponent;

abstract class HTMLBodyComponent
{
    protected ?HTMLComponent $bodyComponent;

    /**
     * Creates HTML Body Component
     */
    public abstract function create(): void;

    /**
     * Returns HTML Component
     */
    public function getComponent()
    {
        return $this->bodyComponent;
    }

    /**
     * Shows HTML Body Component
     */
    public function show(): void
    {
        if ($this->bodyComponent != null) {
            $this->bodyComponent->show();
        }
    }
}
