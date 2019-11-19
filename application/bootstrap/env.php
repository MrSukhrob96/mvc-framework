<?php
require_once dirname(__DIR__).'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
$dotenv->load();
