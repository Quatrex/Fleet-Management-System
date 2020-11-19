<?php

namespace Report;

interface IVisitor{
    public function visit(IVisitable $visitable,string $visitableType);
}