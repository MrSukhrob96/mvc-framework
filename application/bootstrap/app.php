<?php
require_once dirname(__DIR__).'/vendor/autoload.php';

define('_APP_',dirname(__DIR__)."/app");
define('_BOOT_',dirname(__DIR__)."/bootstrap");
define('_VIEWS_',dirname(__DIR__)."/views");
define('_LAYOUTS_',dirname(__DIR__)."/views/layouts");

require_once "env.php";
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpFoundation\Request;


$request = Request::createFromGlobals();

/**
 * @var $routes \Symfony\Component\Routing\RouteCollection
 */
$routes = require_once "routing.php";
/**
 * @var $container \Symfony\Component\DependencyInjection\ContainerBuilder
 */
$container = require_once "container.php";

\Framework\Framework::create($request,$routes,$container);