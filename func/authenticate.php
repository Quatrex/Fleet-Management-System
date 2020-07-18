<?php
require_once '../includes/autoloader.inc.php';
use Validator\Authenticate;

session_start();
Authenticate::authenticateMe();
?>