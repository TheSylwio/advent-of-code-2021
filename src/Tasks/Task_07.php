<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_07 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		[$input] = $this->getInput();
		$fuels = array_map('intval', explode(',', $input));
		$minFuel = null;

		foreach ($fuels as $fuel) {
			$sum = array_reduce($fuels, function ($acc, $item) use ($fuel) {
				return $acc + (max($fuel, $item) - min($fuel, $item));
			});

			if (is_null($minFuel) || $sum < $minFuel) {
				$minFuel = $sum;
			}
		}

		$this->displayResult($minFuel);
	}

	public function executeSecondPart() {
		// TODO: Implement executeSecondPart() method.
	}
}