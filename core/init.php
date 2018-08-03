<?php


session_start();

// load Class
spl_autoload_register(function($class) {
    require_once 'class/' . $class . '.php';
});