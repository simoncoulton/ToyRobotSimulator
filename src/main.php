<?php

// Rudimentary autoloader to facilitate PSR-0 from base directory.
spl_autoload_register(function($class) {
	$path = DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class);
	include dirname(__FILE__).$path.'.php';
});

// Require the namespaces
use ToyRobotSimulator\App;
use ToyRobotSimulator\Controller\Controller;
use ToyRobotSimulator\Model\Robot;
use ToyRobotSimulator\View\Stdout;

// Determine whether or not we're reading from a file or from the stdin
$input = !empty($argv[1]) && file_exists($argv[1]) ? $argv[1] : 'php://stdin';

// Initialize a new instance of the application and the relevant mvc components
$app = new App(new Controller, new Robot, new Stdout);

// Run the application
$app->run($input);
