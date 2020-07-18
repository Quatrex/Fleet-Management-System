<?php

namespace UI;

class CardBuilder extends CompositeBuilder{
    
    public function createCard(array $attributes=[]):CardBuilder
    {
        return $this->createComposite('div',  $attributes);
    }
}