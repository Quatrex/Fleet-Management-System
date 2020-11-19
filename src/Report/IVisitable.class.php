<?php

namespace Report;

interface IVisitable{
    public function accept(IVisitor $requestToken,string $visitableType);
    public function getInfo():array;
}