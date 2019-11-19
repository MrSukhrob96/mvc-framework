<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
$entityManager = require_once 'bootstrap/db.php';


return ConsoleRunner::createHelperSet($entityManager);