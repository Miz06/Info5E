<?php
echo '<br>';

$now = new DateTime();

echo $now->format('Y-m-d H:i:s');
echo '<br>';

echo $now->format('d-m-Y H:i:s');
echo '<br>';

echo $now->format('H:i:s');
echo '<br>';

echo $now->format('Y-m-d');
echo '<br>';

//date +/- value
$date1 = new DateTime(datetime: '-3 months');
echo $date1->format("Y-m-d H:i:s");
echo '<br>';

$date2 = new DateTime(datetime: '+2 hours');
echo $date2->format("Y-m-d H:i:s");
echo '<br>';

$date3 = new DateTime(datetime: '-5years');
echo $date3->format("Y-m-d H:i:s");
echo '<br>';

//clone - setDate
$date4 = clone $date3;
$date4->setDate(2030, 10, 29);
echo $date4->format("Y-m-d H:i:s");
echo '<br>';

//diff
$date5 = new DateTime(datetime: '+10 days');
$date6 = new DateTime(datetime: '-15 days');
$interval = $date5->diff($date6);
echo $interval->format("%y-%m-%d-%H-%I-%S");
echo '<br>';

//object DateInterval(P: period[years-months-days] \ T: time[hours-minutes-seconds])
$intervalTime = new DateInterval('P1Y3M4DT2H3M4S');
echo $intervalTime->format("%y-%m-%d %H:%I:%S");
echo '<br>';

$date7 = $now->add($intervalTime);
echo $date7->format("Y-m-d H:i:s");
echo '<br>';

//---------------------------------------------------------
echo '-----------------------------------';
echo '<br>';

// Create a new DateTime object
$date = new DateTime();
echo "Current date and time: " . $date->format('Y-m-d H:i:s') . "\n";
echo '<br>';

// Set a specific date and time
$date->setDate(2024, 12, 12);
$date->setTime(15, 30);
echo "Updated date and time: " . $date->format('Y-m-d H:i:s') . "\n";
echo '<br>';

// Add and subtract time intervals
$date->add(new DateInterval('P10D')); // Add 10 days
echo "Date after adding 10 days: " . $date->format('Y-m-d H:i:s') . "\n";
echo '<br>';

$date->sub(new DateInterval('P5D')); // Subtract 5 days
echo "Date after subtracting 5 days: " . $date->format('Y-m-d H:i:s') . "\n";
echo '<br>';

// Calculate the difference between two dates
$date1 = new DateTime('2024-12-01');
$date2 = new DateTime('2024-12-12');
$diff = $date1->diff($date2);
echo "Difference: " . $diff->days . " days\n";
echo '<br>';

// Modify a date directly
$date->modify('+1 month');
echo "Date after modifying: " . $date->format('Y-m-d H:i:s') . "\n";
echo '<br>';

// Using DateInterval explicitly
$interval = new DateInterval('P2Y4M');
echo "Interval created: " . $interval->format('%y years %m months') . "\n";
echo '<br>';