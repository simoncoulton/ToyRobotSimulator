<?php

/**
 * @namespace
 */
namespace ToyRobotSimulator\Model;

use \SplObserver;
use \SplObjectStorage;

/**
 * Base model class providing common methods to be implemented by models within
 * the application.
 *
 * @category   ToyRobotSimulator
 * @package    Model
 */
abstract class Model implements IModel
{
	protected $observers;

	public function __construct()
	{
		$this->clearObservers();
	}

	public function attach(SplObserver $observer)
	{
		$this->observers->attach($observer);
	}

	public function detach(SplObserver $observer)
	{
		$this->observers->detach($observer);
	}

	public function clearObservers()
	{
		$this->observers = new SplObjectStorage;
	}

	public function notify()
	{
		foreach ($this->observers as $observer) {
			$observer->update($this);
		}
	}
}
