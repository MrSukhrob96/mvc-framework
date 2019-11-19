<?php

require_once "env.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(dirname(__DIR__)."/app"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$connectionParams = array(
    'dbname' => getenv("DB_NAME"),
    'user' => getenv("DB_USER"),
    'password' => getenv("DB_PASS"),
    'host' => getenv("DB_HOST"),
    'driver' => getenv("DB_DRIVER"),
);

return EntityManager::create($connectionParams, $config);