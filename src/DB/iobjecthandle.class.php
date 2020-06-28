<?php
namespace DB;

interface IObjectHandle{
    public static function getObject(int $ID);
    public static function getObjectByValues(array $values);
    //public static function constructObject($values); //cannot declare since PHP doesn't support overloading
    //protected static function saveToDatabase(); //"interface methods cannot be protected"?
}