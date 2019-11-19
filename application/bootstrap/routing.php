<?php
use Symfony\Component\Config\FileLocator;

$fileLocator = new FileLocator([__DIR__]);
$loader = new \Symfony\Component\Routing\Loader\PhpFileLoader($fileLocator);
return $loader->load('../routes/web.php');