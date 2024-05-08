<!DOCTYPE html>
<html>
<head>
    <title>Пошук навчальних предметів</title>
</head>
<body>

<h2>Пошук навчальних предметів</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Введіть символи для пошуку: <input type="text" name="search"><br>
    <input type="submit" value="Пошук">
</form>

<?php
// Функція для читання даних з файлу та виведення предметів, назви яких містять задані символи
function searchSubjects($filename, $searchString) {
    if (file_exists($filename)) {
        $file = fopen($filename, "r");
        if ($file) {
            $found = false; // Прапорець для визначення, чи знайдено хоча б один предмет
            while (($line = fgets($file)) !== false) {
                // Отримання назви предмету з файлу
                $subject = trim($line);
                // Перевірка, чи містить назва предмету заданий рядок символів
                if (stripos($subject, $searchString) !== false) {
                    // Якщо так, виведення предмету
                    echo "<p>$subject</p>";
                    $found = true; // Встановлення прапорця, що знайдено хоча б один предмет
                }
                // Пропускаємо інші рядки (номер семестру, години, тощо)
                fgets($file); // Номер семестру
                fgets($file); // Кількість годин
                fgets($file); // Форма контролю
                fgets($file); // Прізвище та ім'я лектора
            }
            fclose($file);
            // Виведення повідомлення, якщо не знайдено жодного предмету
            if (!$found) {
                echo "<p>Предмети, що містять задані символи, не знайдено</p>";
            }
        } else {
            echo "Помилка читання файлу";
        }
    } else {
        echo "Файл не існує";
    }
}

// Обробка введених символів та пошук навчальних предметів
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchString = $_POST["search"];
    if (!empty($searchString)) {
        echo "<h3>Результати пошуку для: $searchString</h3>";
        searchSubjects("data.txt", $searchString);
    } else {
        echo "<p>Будь ласка, введіть символи для пошуку</p>";
    }
}
?>
<h1 style='text-align:center;font-size: 24px;'><a href="index.php">Повернутися на головну сторінку</a></h1>
</body>
</html>
