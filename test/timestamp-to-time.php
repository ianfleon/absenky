<?php

// echo date('H:i:s', 1299446702);

list($day, $month, $year) = explode('-', date('d-m-Y'));

$startTodayTimestamp = mktime(0, 0, 0, $month, $day, $year);
$endTodayTimestamp = $startTodayTimestamp + (3600 * 24) - 1;

// echo date('H:i:s', ($endTodayTimestamp)); 
echo "start: " . $startTodayTimestamp . PHP_EOL;
echo "end: " . $endTodayTimestamp;

// echo $month;