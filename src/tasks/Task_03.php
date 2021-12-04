<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;

class Task_03 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$values = $this->getInput(trimmed: true);
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
		$isOxygenRatingFound = false;
		$isCo2RatingFound = false;

		for ($i = 0; $i < $rowLength; $i++) {
			$regExpZero = sprintf('/.{%s}[0].{%s}/', $i, $rowLength - $i - 1);
			$regExpOne = sprintf('/.{%s}[1].{%s}/', $i, $rowLength - $i - 1);
			preg_match_all($regExpZero, $oxygenRating, $matchesOxygenZero);
			preg_match_all($regExpOne, $oxygenRating, $matchesOxygenOne);
			preg_match_all($regExpZero, $co2Rating, $matchesCo2Zero);
			preg_match_all($regExpOne, $co2Rating, $matchesCo2One);

			if (!$isOxygenRatingFound) {
				if (count($matchesOxygenZero[0]) === 0 || count($matchesOxygenOne[0]) === 0) {
					$oxygenRating = max($matchesOxygenZero[0], $matchesOxygenOne[0])[0];
					$isOxygenRatingFound = true;
				} else if (count($matchesOxygenZero[0]) === count($matchesOxygenOne[0])) {
					$oxygenRating = join("\n", $matchesOxygenOne[0]);
				} else {

					$oxygenRating = join("\n", max($matchesOxygenZero[0], $matchesOxygenOne[0]));
				}
			}

			if (!$isCo2RatingFound) {
				if (count($matchesCo2Zero[0]) === 0 || count($matchesCo2One[0]) === 0) {
					$co2Rating = max($matchesCo2Zero[0], $matchesCo2One[0])[0];
					$isCo2RatingFound = true;
				} else if (count($matchesCo2Zero[0]) === count($matchesCo2One[0])) {
					$co2Rating = join("\n", $matchesCo2Zero[0]);
				} else {
					$co2Rating = join("\n", min($matchesCo2Zero[0], $matchesCo2One[0]));
				}
			}
		}

		$oxygenRating = intval($oxygenRating, 2);
		$co2Rating = intval($co2Rating, 2);

		$result = $oxygenRating * $co2Rating;
		echo "Day 03 ~ Part 2 | Result: $result \r\n";
	}
}