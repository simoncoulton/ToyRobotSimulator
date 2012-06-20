<?php

/**
 * @namespace
 */
namespace ToyRobotSimulator\View;

use \SplSubject;

/**
 * Basic view for displaying content within the CLI.
 *
 * @category   ToyRobotSimulator
 * @package    View
 */
class Stdout implements IView
{
	public function update(SplSubject $model)
	{
		if ($model->isInitialized()) {
			$this->render(vsprintf('%d,%d,%s', $model->getLocation()));
		}
	}

	public function render($output)
	{
		echo $output . "\n";
	}
}