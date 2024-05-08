<?php
$currentDate = new DateTime();
$newYear = new DateTime(date('Y') . '-01-01');

if ($currentDate > $newYear) {
    $newYear->modify('+1 year');
}
$interval = $newYear->diff($currentDate);
echo "<h1 style='text-align:center; font-size: 24px;'>До Нового року залишилося " . $interval->days . " днів.</h1>";
?>
<h1 style='text-align:center;font-size: 24px;'><a href="index.php">Повернутися на головну сторінку</a></h1>