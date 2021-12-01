<?php

namespace App;

require 'vendor/autoload.php';

use App\Tasks\Task_01;

$task1 = new Task_01();
$task1->executeFirstPart();
$task1->executeSecondPart();