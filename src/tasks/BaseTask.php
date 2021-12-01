<?php

namespace App\Tasks;

use App\Helper;

class BaseTask {
	private array $input;

	public function __construct() {
		$inputNumber = explode('App\Tasks\Task_', get_class($this))[1];
		$this->input = Helper::readFile($inputNumber);
	}

	public function getInput(): array {
		return $this->input;
	}
}