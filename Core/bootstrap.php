<?php

if (!session_id()) {
    session_start();
}

$routes = require(__DIR__ . "/../App/routes.php");
$route = new \Core\Route($routes);

