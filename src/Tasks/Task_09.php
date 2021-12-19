<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_09 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$input = $this->getInput(trimmed: true);
		$matrix = array_map(fn(string $row) => array_map('intval', str_split($row)), $input);
		$matrixWithPadding = $this->addMatrixPadding($matrix);
		$lowestPoints = [];

		for ($i = 1; $i < count($matrixWithPadding) - 1; $i++) {
			for ($j = 1; $j < count($matrixWithPadding[$i]) - 1; $j++) {
				if ($this->hasLowerAdjacentLocations($i, $j, $matrixWithPadding)) {
					continue;
				}
				$lowestPoints[] = $matrixWithPadding[$i][$j] + 1;
			}
		}

		$this->displayResult(array_sum($lowestPoints));
	}

	private function hasLowerAdjacentLocations(int $i, int $j, array $matrix): bool {
		$adjacentLocations = [$matrix[$i - 1][$j], $matrix[$i + 1][$j], $matrix[$i][$j - 1], $matrix[$i][$j + 1]];
		$currentCell = $matrix[$i][$j];

		foreach ($adjacentLocations as $location) {
			if ($location <= $currentCell) {
				return true;
			}
		}

		return false;
	}

	/** @param array[][] $matrix */
	private function addMatrixPadding(array $matrix): array {
		$columnsCount = count($matrix[0]);

		$paddingRow = array_fill(0, $columnsCount, 9);
		$newMatrix = [$paddingRow, ...$matrix, $paddingRow];

		foreach ($newMatrix as &$row) {
			$row = [9, ...$row, 9];
		}

		return $newMatrix;
	}

	public function executeSecondPart() {
		// TODO: Implement executeSecondPart() method.
	}
}