<?php

namespace App;

class Helper {
	public static function readFile(string $inputNumber, bool $trimmed): array {
		$path = sprintf('%s\inputs\input_%s.txt', __DIR__, $inputNumber);
		$input = fopen($path, "r");
		$array = [];

		while (!feof($input)) {
			$array[] = fgets($input);
		}

		if ($trimmed) {
			return array_map(fn($item) => trim($item), $array);
		}

		return $array;
	}
}