<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_02 extends BaseTask implements TaskInterface {
	/** @var array|string[][] */
	private array $commands;

	public function __construct() {
		$this->commands = array_map(fn($command) => explode(' ', $command), $this->getInput(trimmed: true));
	}

	public function executeFirstPart() {
		$position = 0;
		$depth = 0;

		foreach ($this->commands as [$direction, $value]) {
			switch ($direction) {
				case 'forward':
					$position += (int)$value;
					break;
				case 'up':
					$depth -= (int)$value;
					break;
				case 'down':
					$depth += (int)$value;
			}
		}

		$this->displayResult($position * $depth);
	}

	public function executeSecondPart() {
		$position = 0;
		$depth = 0;
		$aim = 0;

		foreach ($this->commands as [$direction, $value]) {
			switch ($direction) {
				case 'forward':
					$position += (int)$value;
					$depth += $aim * (int)$value;
					break;
				case 'up':
					$aim -= (int)$value;
					break;
				case 'down':
					$aim += (int)$value;
			}
		}

		$this->displayResult($position * $depth);
	}
}