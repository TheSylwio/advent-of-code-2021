<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_10 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$rows = $this->getInput(trimmed: true);
		$illegalCharacters = [];
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

				if (!$areMatchingBrackets) {
					$illegalCharacters[] = $character;
					break;
				}
			}
		}
		$syntaxErrorScore = $this->getSyntaxErrorScore($illegalCharacters);
		$this->displayResult($syntaxErrorScore);
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

	public function executeSecondPart() {
		// TODO: Implement executeSecondPart() method.
	}
}