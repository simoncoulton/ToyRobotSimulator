<?php

/**
 * @namespace
 */
namespace ToyRobotSimulator\Model;

/**
 * The robot model provides utility methods to move the robot within it's given
 * bounds.
 *
 * @category   ToyRobotSimulator
 * @package    Model
 */
class Robot extends Model
{
	protected $bounds;
	protected $x;
	protected $y;
	protected $direction;
	protected $initialized;
	protected $directions = array('NORTH', 'EAST', 'SOUTH', 'WEST');

	public function __construct(array $bounds = array(5,5))
	{
		$this->bounds = $bounds;
		parent::__construct();
	}

	// Callable methods from the CLI or input file -----------------------------
	public function place($x, $y, $direction)
	{
		if (!$this->initialized && $this->isValidPosition($x, $y)) {
			$this->x = $x;
			$this->y = $y;
			$this->direction = $direction;
			$this->initialized = true;
		}
	}

	public function move()
	{
		if ($this->initialized) {
			$next = $this->calculateNextPosition();
			$newX = $this->x + $next[0];
			$newY = $this->y + $next[1];
			if ($this->isValidPosition($newX, $newY)) {
				$this->x = $newX;
				$this->y = $newY;
			}
		}
	}

	public function left()
	{
		$index = array_search($this->direction, $this->directions);
		$index--;
		if ($index < 0) {
			$index = count($this->directions) - 1;
		}
		$this->direction = $this->directions[$index];
	}

	public function right()
	{
		$index = array_search($this->direction, $this->directions);
		$index++;
		if ($index > count($this->directions)) {
			$index = 0;
		}
		$this->direction = $this->directions[$index];
	}

	public function report()
	{
		if ($this->initialized) {
			$this->notify();

			return true;	
		}
	}

	// End of callable methods -------------------------------------------------

	public function getLocation()
	{
		return array($this->x, $this->y, $this->direction);
	}

	public function isInitialized()
	{
		return $this->initialized;
	}

	protected function calculateNextPosition()
	{
		$x = 0;
		$y = 0;
		switch ($this->direction) {
			case 'NORTH':
				$y = 1;
				break;
			case 'EAST':
				$x = 1;
				break;
			case 'SOUTH':
				$y = -1;
				break;
			case 'WEST':
				$x = -1;
				break;
		}

		return array($x, $y);
	}

	protected function isValidPosition($x, $y)
	{
		$valid = true;
		if ($x > $this->bounds[0] || $x < 0) {
			$valid = false;
		}
		if ($y > $this->bounds[1] || $y < 0) {
			$valid = false;
		}

		return $valid;
	}
}