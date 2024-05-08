<!DOCTYPE html>
<html>
<head>
    <title>Lab work #2</title>
</head>
<body>

<h2>Інформація про навчальні предмети</h2>

<?php
// Функція для читання даних з файлу та виведення їх у відповідному форматі
function displaySubjects($filename) {
    if (file_exists($filename)) {
        $file = fopen($filename, "r");
        $count = 1;
        if ($file) {
            while (($line = fgets($file)) !== false) {
                // Отримання даних з файлу
                $subject = trim($line);
                $semester = trim(fgets($file));
                $hours = trim(fgets($file));
                $assessment = trim(fgets($file));
                $lecturer = trim(fgets($file));

                // Виведення даних у відповідному форматі
                echo "<p>$count. $subject</p>";
                echo "<p>Номер семестру: $semester</p>";
                echo "<p>Кількість годин: $hours</p>";
                echo "<p>Форма контролю: $assessment</p>";
                echo "<p>Прізвище та ім'я лектора: $lecturer</p><br>";

                $count++;
            }
            fclose($file);
        } else {
            echo "Помилка читання файлу";
        }
    } else {
        echo "Файл не існує";
    }
}

// Виведення існуючих записів
displaySubjects("data.txt");

// Обробка додавання нового запису
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $semester = $_POST["semester"];
    $hours = $_POST["hours"];
    $assessment = $_POST["assessment"];
    $lecturer = $_POST["lecturer"];

    // Перевірка на заповненість усіх полів форми
    if (!empty($subject) && !empty($semester) && !empty($hours) && !empty($assessment) && !empty($lecturer)) {
        // Додавання нового запису до файлу
        $newData = "$subject\n$semester\n$hours\n$assessment\n$lecturer\n\n";
        file_put_contents("data.txt", $newData, FILE_APPEND | LOCK_EX);

        // Перенаправлення на цю ж сторінку для оновлення відображення
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Будь ласка, заповніть усі поля форми";
    }
}
?>
<h1 style='text-align:center;font-size: 24px;'><a href="index.php">Повернутися на головну сторінку</a></h1>
<hr>
<h2>Додати новий предмет</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Назва предмету: <input type="text" name="subject"><br>
    Номер семестру: <input type="number" name="semester"><br>
    Кількість годин: <input type="number" name="hours"><br>
    Форма контролю: <input type="text" name="assessment"><br>
    Прізвище та ім'я лектора: <input type="text" name="lecturer"><br>
    <input type="submit" value="Додати">
</form>

</body>
</html>
