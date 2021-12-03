<?php

namespace App;

require 'vendor/autoload.php';

use App\Interfaces\TaskInterface;
use App\Tasks\Task_01;
use App\Tasks\Task_02;
use App\Tasks\Task_03;

/** @var TaskInterface[] $tasks */
$tasks = [new Task_01(), new Task_02(), new Task_03()];

foreach ($tasks as $task) {
	$task->executeFirstPart();
	$task->executeSecondPart();
}