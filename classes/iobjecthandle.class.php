<?php
interface IObjectHandle{
    //make an object using an existing record in the table (by a unique ID)
    public static function getObject();

    //use this instead of the default constructor
    //overload this function with required parameters
    public static function constructObject();

}