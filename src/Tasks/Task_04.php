<?php

namespace App\Tasks;

use App\Helper;
use App\Interfaces\TaskInterface;
use stdClass;

class Task_04 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$input = $this->getInput(trimmed: true);
		[$winningNumbers, $boards] = $this->getParts($input);
		$boardSteps = [];

		foreach ($boards as $board) {
			$boardSteps[] = $this->getStepsCount($board, $winningNumbers);
		}

		$neededStepsToWin = min($boardSteps);
		$lastValue = $winningNumbers[$neededStepsToWin - 1];
		$sumNumbers = $this->getSum($boards, $neededStepsToWin, $boardSteps);

		$this->displayResult($sumNumbers * $lastValue);
	}

	public function executeSecondPart() {
		$input = $this->getInput(trimmed: true);
		[$winningNumbers, $boards] = $this->getParts($input);
		$boardSteps = [];

		foreach ($boards as $board) {
			$boardSteps[] = $this->getStepsCount($board, $winningNumbers);
		}

		$neededStepsToWin = max($boardSteps);
		$lastValue = $winningNumbers[$neededStepsToWin - 1];
		$sumNumbers = $this->getSum($boards, $neededStepsToWin, $boardSteps);

		$this->displayResult($sumNumbers * $lastValue);
	}

	private function getSum(array $boards, int $stepCount, array $boardSteps) {
		$searchedBoard = $boards[array_search($stepCount, $boardSteps)];
		return array_reduce($searchedBoard, function ($acc, $row) {
			$sum = 0;
			foreach ($row as $element) {
				if (!$element->isChecked) {
					$sum += $element->value;
				}
			}
			return $acc + $sum;
		});
	}

	/**
	 * @param array[][] $board
	 * @param int[] $winningNumbers
	 */
	private function getStepsCount(array $board, array $winningNumbers): int {
		$count = 0;

		foreach ($winningNumbers as $number) {
			foreach ($board as $row) {
				/** @var stdClass $element */
				foreach ($row as $element) {
					if ($element->value === $number) {
						$element->isChecked = true;
					}
				}
			}

			if (++$count >= 5) {
				if ($this->isBoardWinning($board)) {
					return $count;
				}
			}
		}

		return $count;
	}

	private function checkWinningRows(array $board): bool {
		foreach ($board as $row) {
			$isWinningRow = true;
			foreach ($row as $element) {
				if (!$element->isChecked) {
					$isWinningRow = false;
					break;
				}
			}

			if ($isWinningRow) {
				return true;
			}
		}
		return false;
	}

	private function checkWinningColumns(array $board): bool {
		$transposed = Helper::transposeMatrix($board);
		return $this->checkWinningRows($transposed);
	}

	private function isBoardWinning(array $board): bool {
		return $this->checkWinningRows($board) || $this->checkWinningColumns($board);
	}

	private function getParts(array $input): array {
		$winningNumbers = array_map('intval', explode(',', $input[0]));
		$boards = [];

		for ($i = 2; $i < count($input); $i += 6) {
			$rows = array_slice($input, $i, 5);
			$boards = [...$boards, $this->createBoard($rows)];
		}

		return [$winningNumbers, $boards];
	}

	private function createBoard(array $rows): array {
		foreach ($rows as &$row) {
			$row = array_map(function ($item) {
				$stdClass = new stdClass();
				$stdClass->value = (int)$item;
				$stdClass->isChecked = false;

				return $stdClass;
			}, array_filter(explode(" ", $row), fn($item) => $item !== ""));
		}
		return $rows;
	}
}