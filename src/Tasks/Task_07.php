<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_07 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$minFuel = $this->getMinFuel();
		$this->displayResult($minFuel);
	}

	public function executeSecondPart() {
		$minFuel = $this->getMinFuel(true);
		$this->displayResult($minFuel);
	}

	private function getMinFuel(bool $withSum = false): int {
		[$input] = $this->getInput();
		$fuels = array_map('intval', explode(',', $input));

		$fuelRange = $withSum ? range(1, max($fuels)) : $fuels;

		return array_reduce($fuelRange, function ($acc, $fuel) use ($withSum, $fuels) {
			$fuelSum = array_reduce($fuels, function ($acc2, $item) use ($withSum, $fuel) {
				$diff = abs($fuel - $item);
				return $withSum ? $acc2 + array_sum(range(0, $diff)) : $acc2 + $diff;
			});
			return min($fuelSum, $acc);
		}, PHP_INT_MAX);
	}
}