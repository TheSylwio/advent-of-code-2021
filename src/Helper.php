<?php

namespace App;

class Helper {
	public static function readFile(string $inputNumber): array {
		$path = sprintf('%s\inputs\input_%s.txt', __DIR__, $inputNumber);
		$input = fopen($path, "r");
		$array = [];

		while (!feof($input)) {
			$array[] = (int)fgets($input);
		}

		return $array;
	}
}