<?php

namespace App\Tasks;

use App\Interfaces\TaskInterface;
use stdClass;

class Task_05 extends BaseTask implements TaskInterface {
	public function executeFirstPart() {
		$vents = $this->getVents();
		$filteredVents = array_filter($vents, fn($vent) => $vent->startX === $vent->endX || $vent->startY === $vent->endY);
		$diagram = $this->getDiagram($filteredVents);
		$overlappingPoints = array_filter($diagram, fn($point) => $point > 1);

		$this->displayResult(count($overlappingPoints));
	}

	public function executeSecondPart() {
		$vents = $this->getVents();
		$diagram = $this->getDiagram($vents);
		$overlappingPoints = array_filter($diagram, fn($point) => $point > 1);

		$this->displayResult(count($overlappingPoints));
	}

	private function getDiagram(array $vents): array {
		$diagram = [];

		foreach ($vents as $vent) {
			if ($vent->startX === $vent->endX) {
				foreach (range($vent->startY, $vent->endY) as $cord) {
					$key = $vent->startX . ',' . $cord;
					$diagram[$key] = isset($diagram[$key]) ? $diagram[$key] + 1 : 1;
				}
				continue;
			}

			if ($vent->startY === $vent->endY) {
				foreach (range($vent->startX, $vent->endX) as $cord) {
					$key = $cord . ',' . $vent->startY;
					$diagram[$key] = isset($diagram[$key]) ? $diagram[$key] + 1 : 1;
				}
				continue;
			}

			$factor = ($vent->startY - $vent->endY) / ($vent->startX - $vent->endX);
			$rest = $vent->startY - $factor * $vent->startX;

			foreach (range(min($vent->startX, $vent->endX), max($vent->startX, $vent->endX)) as $cordX) {
				$key = $cordX . ',' . $factor * $cordX + $rest;
				$diagram[$key] = isset($diagram[$key]) ? $diagram[$key] + 1 : 1;
			}
		}

		return $diagram;
	}

	private function getVents(): array {
		return array_map(function ($line) {
			[$startPoint, $endPoint] = explode(' -> ', $line);

			$stdClass = new stdClass();
			$stdClass->startX = (int)explode(',', $startPoint)[0];
			$stdClass->startY = (int)explode(',', $startPoint)[1];
			$stdClass->endX = (int)explode(',', $endPoint)[0];
			$stdClass->endY = (int)explode(',', $endPoint)[1];

			return $stdClass;
		}, $this->getInput());
	}
}