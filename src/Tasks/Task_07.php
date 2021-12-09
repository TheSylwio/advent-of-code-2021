<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_07 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		[$input] = $this->getInput();
		$fuels = array_map('intval', explode(',', $input));
		$minFuel = $this->getMinFuel($fuels);

		$this->displayResult($minFuel);
	}

	public function executeSecondPart() {
		// TODO: Implement executeSecondPart() method.
	}

	private function getMinFuel(array $fuels): int {
		return array_reduce($fuels, function ($acc, $fuel) use ($fuels) {
			$fuelSum = array_reduce($fuels, function ($acc2, $item) use ($fuel) {
				return $acc2 + abs($fuel - $item);
			});
			return min($fuelSum, $acc);
		}, PHP_INT_MAX);
	}
}