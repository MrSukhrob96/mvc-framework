<?php

use App\Http\Controller\BlogController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Routing\Route;

return function (RoutingConfigurator $routes) {

    $routes->add('home', '/')->controller([\App\Http\Controller\TaskController::class,'index']);
    $routes->add('update', '/update/{id}')->controller([\App\Http\Controller\TaskController::class,'update']);

    $routes->add('login', '/user/login')->controller([\App\Http\Controller\UserController::class, 'login']);
    $routes->add('logout', '/user/logout')->controller([\App\Http\Controller\UserController::class, 'logout']);
};
