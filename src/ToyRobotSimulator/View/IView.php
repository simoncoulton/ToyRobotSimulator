<?php

/**
 * @namespace
 */
namespace ToyRobotSimulator\View;

use \SplSubject;
use \SplObserver;

/**
 * Interface contact for views.
 *
 * @category   ToyRobotSimulator
 * @package    View
 */
interface IView extends SplObserver
{
	public function update(SplSubject $model);
	public function render($output);
}