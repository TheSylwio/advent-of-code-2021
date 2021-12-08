<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_06 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		[$input] = $this->getInput();
		$fish = array_map('intval', explode(',', $input));

		for ($day = 0; $day < 80; $day++) {
			$fishToAdd = 0;
			foreach ($fish as &$singleFish) {
				if ($singleFish === 0) {
					$fishToAdd++;
					$singleFish = 6;
					continue;
				}
				$singleFish--;
			}

			while ($fishToAdd > 0) {
				array_push($fish, 8);
				$fishToAdd--;
			}
		}

		$this->displayResult(count($fish));
	}

	public function executeSecondPart() {
		// TODO: Implement executeSecondPart() method.
	}
}