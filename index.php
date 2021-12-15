<?php

namespace App;

require 'vendor/autoload.php';

for ($i = 1; $i <= 25; $i++) {
	$className = 'App\Tasks\Task_' . sprintf("%02d", $i);
	if (class_exists($className)) {
		$task = new $className();
		$task->executeFirstPart();
		$task->executeSecondPart();
	}
}