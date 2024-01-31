<?php

// echo date('H:i:s', 1299446702);

list($day, $month, $year) = explode('-', date('d-m-Y'));

$startTodayTimestamp = mktime(0, 0, 0, $month, $day, $year);
$endTodayTimestamp = $todayTimestamp + (3600 * 24) - 1;

echo date('H:i:s', ($endTodayTimestamp)); 

// echo $month;