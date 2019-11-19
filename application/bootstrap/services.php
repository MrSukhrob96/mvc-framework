<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Repositories\TaskRepository;
use App\TaskService;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();
    $services->set(TaskRepository::class, TaskRepository::class);

};