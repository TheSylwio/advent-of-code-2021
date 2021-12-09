<?php

namespace App;

require 'vendor/autoload.php';

use App\Interfaces\TaskInterface;
use App\Tasks\Task_01;
use App\Tasks\Task_02;
use App\Tasks\Task_03;
use App\Tasks\Task_04;
use App\Tasks\Task_05;
use App\Tasks\Task_06;
use App\Tasks\Task_07;

/** @var TaskInterface[] $tasks */
$tasks = [new Task_01(), new Task_02(), new Task_03(), new Task_04(), new Task_05(), new Task_06(), new Task_07()];

foreach ($tasks as $task) {
	$task->executeFirstPart();
	$task->executeSecondPart();
}