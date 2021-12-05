<?php

namespace App\Tasks;

use App\Helper;

abstract class BaseTask {
	protected function getInput($trimmed = false): array {
		$inputNumber = explode('App\Tasks\Task_', get_called_class())[1];
		return Helper::readFile($inputNumber, $trimmed);
	}

	protected function displayResult(mixed $result): void {
		$day = explode('App\Tasks\Task_', get_called_class())[1];
		$part = debug_backtrace()[1]['function'] === 'executeFirstPart' ? 1 : 2;

		echo "Day $day ~ Part $part | Result: $result \r\n";
	}
}