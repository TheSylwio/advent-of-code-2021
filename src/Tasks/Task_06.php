<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_06 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$result = $this->getFishCount(80);
		$this->displayResult($result);
	}

	public function executeSecondPart() {
		$result = $this->getFishCount(256);
		$this->displayResult($result);
	}

	private function getFishCount(int $days): int {
		[$input] = $this->getInput();
		$fish = array_map('intval', explode(',', $input));

		$values = array_fill(0, 9, 0);
		foreach ($fish as $singleFish) {
			$values[$singleFish] += 1;
		}

		for ($i = 0; $i < $days; $i++) {
			$newFish = array_shift($values);

			$values[6] += $newFish;
			$values[8] = $newFish;
		}


		return array_sum($values);
	}
}