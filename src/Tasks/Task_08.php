<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_08 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$input = $this->getInput();
		$lines = array_map(fn($line) => trim(explode('|', $line)[1]), $input);
		$uniqueDigits = array_reduce($lines, fn($acc, $line) => $acc + $this->getUniqueDigitsCount($line), 0);

		$this->displayResult($uniqueDigits);
	}

	public function executeSecondPart() {
		// TODO: Implement executeSecondPart() method.
	}

	private function getUniqueDigitsCount(string $line): int {
		return count(array_filter(explode(' ', $line), 'self::isUniqueDigit'));
	}

	private static function isUniqueDigit(string $digit): bool {
		return in_array(strlen($digit), [2, 3, 4, 7]);
	}
}