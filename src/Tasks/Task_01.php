<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_01 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$values = array_map('intval', $this->getInput());
		$measurements = 0;

		for ($i = 1; $i < count($values); $i++) {
			if ($values[$i - 1] < $values[$i]) {
				$measurements++;
			}
		}

		$this->displayResult($measurements);
	}

	public function executeSecondPart() {
		$values = array_map('intval', $this->getInput());
		$measurements = 0;

		for ($i = 0; $i < count($values) - count($values) % 3 - 1; $i++) {
			$previous = array_sum(array_slice($values, $i, 3));
			$next = array_sum(array_slice($values, $i + 1, 3));

			if ($previous < $next) {
				$measurements++;
			}
		}

		$this->displayResult($measurements);
	}
}