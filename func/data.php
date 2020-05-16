<?php
function getPendingTrips()
{
    return json_decode(file_get_contents(__DIR__ . '/data.json'), true);
}

function getUser()
{
    return json_decode(file_get_contents(__DIR__ . '/user.json'), true);
}