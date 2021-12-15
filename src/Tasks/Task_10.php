<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_10 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$rows = $this->getInput(trimmed: true);
		$illegalCharacters = $this->iterateRows($rows, true);

		$syntaxErrorScore = $this->getSyntaxErrorScore($illegalCharacters);
		$this->displayResult($syntaxErrorScore);
	}

	public function executeSecondPart() {
		$rows = $this->getInput(trimmed: true);
		$incompleteRows = $this->getIncompleteRows($rows);
		$completionCharacters = $this->iterateRows($incompleteRows);

		$completionPoints = array_map(fn($completion) => $this->getCompletionPoints($completion), $completionCharacters);
		sort($completionPoints);
		$middleScore = $completionPoints[floor(count($completionPoints) / 2)];

		$this->displayResult($middleScore);
	}


	private function iterateRows(array $rows, bool $returnIllegalCharacters = false): array {
		$valuesToReturn = [];

		foreach ($rows as $row) {
			$characters = str_split($row);
			$openingBrackets = [];

			foreach ($characters as $character) {
				if ($this->isOpeningBracket($character)) {
					$openingBrackets[] = $character;
					continue;
				}

				$lastOpeningBracket = array_pop($openingBrackets);
				$areMatchingBrackets = $this->areMatchingBrackets($lastOpeningBracket, $character);

				if (!$areMatchingBrackets && $returnIllegalCharacters) {
					$valuesToReturn[] = $character;
					break;
				}
			}

			if (!$returnIllegalCharacters) {
				$valuesToReturn[] = array_reverse($openingBrackets);
			}

		}
		return $valuesToReturn;
	}

	private function getCompletionPoints(array $completion): int {
		return array_reduce($completion, function ($total, $character) {
			return $total * 5 + $this->getCharacterPoint($character);
		}, 0);
	}

	private function getCharacterPoint(string $character): int {
		return match ($character) {
			'(' => 1,
			'[' => 2,
			'{' => 3,
			'<' => 4,
		};
	}

	private function getIncompleteRows(array $rows): array {
		return array_filter($rows, function (string $row) {
			$characters = str_split($row);
			$openingBrackets = [];

			foreach ($characters as $character) {
				if ($this->isOpeningBracket($character)) {
					$openingBrackets[] = $character;
					continue;
				}

				$lastOpeningBracket = array_pop($openingBrackets);
				$areMatchingBrackets = $this->areMatchingBrackets($lastOpeningBracket, $character);

				if (!$areMatchingBrackets) {
					return false;
				}
			}

			return true;
		});
	}

	private function getSyntaxErrorScore(array $illegalCharacters): int {
		return array_reduce($illegalCharacters, function ($sum, $character) {
			$score = match ($character) {
				')' => 3,
				']' => 57,
				'}' => 1197,
				'>' => 25137,
			};

			return $sum + $score;
		}, 0);
	}

	private function areMatchingBrackets(string $openingBracket, string $closingBracket): bool {
		return match ($openingBracket) {
			'(' => $closingBracket === ')',
			'[' => $closingBracket === ']',
			'{' => $closingBracket === '}',
			'<' => $closingBracket === '>',
		};
	}

	private function isOpeningBracket(string $bracket): bool {
		return in_array($bracket, ['(', '[', '{', '<']);
	}
}