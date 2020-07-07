<?php
namespace EmailClient;

interface INotifiableRequest
{
    public function getField(string $field);
}

