<?php

/**
 * @namespace
 */
namespace ToyRobotSimulator\Controller;

use ToyRobotSimulator\Model\IModel;
use ToyRobotSimulator\View\IView;

/**
 * Sets up communication between the view and the model and sends commands
 * to the model.
 *
 * @category   ToyRobotSimulator
 * @package    Controller
 */
class Controller implements IController
{
	protected $model;
	protected $view;

	public function setView(IView $view)
	{
		if ($this->model) {
			$this->model->attach($view);
		}
		$this->view = $view;

		return $this;
	}

	public function setModel(IModel $model)
	{
		if ($this->view) {
			$model->attach($this->view);
		}
		$this->model = $model;

		return $this;
	}

	public function runCommand($command, $args)
	{
		if (method_exists($this->model, $command)) {
			return call_user_func_array(array($this->model, $command), $args);
		}
	}
}