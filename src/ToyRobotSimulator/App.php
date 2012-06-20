<?php

/**
 * @namespace
 */
namespace ToyRobotSimulator;

/**
 * Wrapper for the application which processes the input source and sends
 * each line from the source to the controller.
 *
 * @category   ToyRobotSimulator
 */
class App
{
	protected $controller;

	public function __construct($controller, $model, $view)
	{
		$this->controller = $controller->setModel($model)
									   ->setView($view);
	}

	public function run($input)
	{
		$input = fopen($input, 'r');
		while ($command = fgets($input)) {
			$command = trim(strtoupper($command), "\n");
			$parts = explode(' ', $command);
			$command = $parts[0];
			$cargs = isset($parts[1]) ? explode(',',$parts[1]) : array();
			if (empty($cargs)) {
				$cargs = array(0, 0, 'NORTH');
			}
			$result = $this->controller->runCommand($command, $cargs);
			if (true === $result) {
				exit;
			}
		}

		return $this;
	}
}