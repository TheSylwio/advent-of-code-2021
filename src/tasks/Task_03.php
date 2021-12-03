<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_03 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$values = array_map(fn($item) => trim($item), $this->getInput());
		$rowsCount = count($values);
		$rowLength = strlen($values[0]);
		$string = join("\n", $values);

		$gammaRate = '';
		$epsilonRate = '';

		for ($i = 0; $i < $rowLength; $i++) {
			$regExp = sprintf('/.{%s}[0].{%s}/', $i, $rowLength - $i - 1);
			preg_match_all($regExp, $string, $matches);

			$zeroOccurrencesInColumn = count($matches[0]);
			$oneOccurrencesInColumn = $rowsCount - $zeroOccurrencesInColumn;

			$gammaRate .= $zeroOccurrencesInColumn > $oneOccurrencesInColumn ? '0' : '1';
			$epsilonRate .= $zeroOccurrencesInColumn > $oneOccurrencesInColumn ? '1' : '0';
		}

		$gammaRate = intval($gammaRate, 2);
		$epsilonRate = intval($epsilonRate, 2);

		$result = $gammaRate * $epsilonRate;
		echo "Day 03 ~ Part 1 | Result: $result \r\n";
	}

	public function executeSecondPart() {
		$values = array_map(fn($item) => trim($item), $this->getInput());
		$rowLength = strlen($values[0]);
		$oxygenRating = join("\n", $values);
		$co2Rating = join("\n", $values);

		for ($i = 0; $i < $rowLength; $i++) {
			$regExpZero = sprintf('/.{%s}[0].{%s}/', $i, $rowLength - $i - 1);
			$regExpOne = sprintf('/.{%s}[1].{%s}/', $i, $rowLength - $i - 1);
			preg_match_all($regExpZero, $oxygenRating, $matches);
			preg_match_all($regExpOne, $oxygenRating, $matchesOne);

			if (count($matches[0]) === count($matchesOne[0])) {
				$oxygenRating = join("\n", $matchesOne[0]);
			} else if (count($matches[0]) === 0 || count($matchesOne[0]) === 0) {
				$oxygenRating = max($matches[0], $matchesOne[0])[0];
				break;
			} else {
				$oxygenRating = join("\n", max($matches[0], $matchesOne[0]));
			}
		}

		for ($i = 0; $i < $rowLength; $i++) {
			$regExpZero = sprintf('/.{%s}[0].{%s}/', $i, $rowLength - $i - 1);
			$regExpOne = sprintf('/.{%s}[1].{%s}/', $i, $rowLength - $i - 1);
			preg_match_all($regExpZero, $co2Rating, $matches);
			preg_match_all($regExpOne, $co2Rating, $matchesOne);

			if (count($matches[0]) === count($matchesOne[0])) {
				$co2Rating = join("\n", $matches[0]);
			} else if (count($matches[0]) === 0 || count($matchesOne[0]) === 0) {
				$co2Rating = max($matches[0], $matchesOne[0])[0];
				break;
			} else {
				$co2Rating = join("\n", min($matches[0], $matchesOne[0]));
			}
		}

		$oxygenRating = intval($oxygenRating, 2);
		$co2Rating = intval($co2Rating, 2);

		$result = $oxygenRating * $co2Rating;
		echo "Day 03 ~ Part 2 | Result: $result \r\n";
	}
}