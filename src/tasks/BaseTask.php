<?php

namespace App\Tasks;

use App\Helper;

class BaseTask {
	public function getInput($trimmed = false): array {
		$inputNumber = explode('App\Tasks\Task_', get_class($this))[1];
		return Helper::readFile($inputNumber, $trimmed);
	}
}