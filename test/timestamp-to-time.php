<?php

// echo date('H:i:s', 1299446702);

$today = explode('-', date('d-m-Y'));

$todayStart = mktime(0, 0, 0, $today[1], $today[0], $today[2]);
$todayEnd = $todayStart + (3600 * 24);

// echo date('H:i:s', ($todayEnd)); 
echo "start: " . $todayStart . PHP_EOL;
echo "end: " . $todayEnd;

// echo $month;