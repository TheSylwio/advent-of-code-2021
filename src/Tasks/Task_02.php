<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_02 extends BaseTask implements TaskInterface {
	/** @var array|string[][] */
	private array $commands;

	public function __construct() {
		$this->commands = array_map(fn($command) => explode(' ', $command), $this->getInput());
	}

	public function executeFirstPart() {
		$position = 0;
		$depth = 0;

		foreach ($this->commands as $command) {
			switch ($command[0]) {
				case 'forward':
					$position += $command[1];
					break;
				case 'up':
					$depth -= $command[1];
					break;
				case 'down':
					$depth += $command[1];
			}
		}

		$result = $position * $depth;
		echo "Day 02 ~ Part 1 | Result: $result \r\n";
	}

	public function executeSecondPart() {
		$position = 0;
		$depth = 0;
		$aim = 0;

		foreach ($this->commands as $command) {
			switch ($command[0]) {
				case 'forward':
					$position += $command[1];
					$depth += $aim * $command[1];
					break;
				case 'up':
					$aim -= $command[1];
					break;
				case 'down':
					$aim += $command[1];
			}
		}
		
		$this->displayResult($position * $depth);
	}
}