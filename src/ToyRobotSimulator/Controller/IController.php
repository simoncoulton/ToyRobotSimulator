<?php

/**
 * @namespace
 */
namespace ToyRobotSimulator\Controller;

use ToyRobotSimulator\Model\IModel;
use ToyRobotSimulator\View\IView;

/**
 * Interface contract for controllers.
 *
 * @category   ToyRobotSimulator
 * @package    Controller
 */
interface IController
{
	public function setView(IView $view);
	public function setModel(IModel $model);
}