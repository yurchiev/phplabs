<?php
// Функція для читання даних з файлу та виведення їх у відповідному форматі
function displaySubjects($filename) {
    if (file_exists($filename)) {
        $file = fopen($filename, "r");
        if ($file) {
            $lecturers = array(); // Масив для зберігання унікальних лекторів
            $subjects = array(); // Масив для зберігання предметів за номером семестру
            while (($line = fgets($file)) !== false) {
                // Отримання даних з файлу
                $subject = trim($line);
                $semester = trim(fgets($file));
                $hours = trim(fgets($file));
                $assessment = trim(fgets($file));
                $lecturer = trim(fgets($file));

                // Записуємо лектора в масив, якщо його ще не було
                if (!in_array($lecturer, $lecturers)) {
                    array_push($lecturers, $lecturer);
                }

                // Додаємо предмет до масиву за номером семестру
                $subjects[$semester][] = array(
                    'subject' => $subject,
                    'semester' => $semester,
                    'hours' => $hours,
                    'assessment' => $assessment,
                    'lecturer' => $lecturer
                );
            }
            fclose($file);

            // Виведення предметів впорядкованих за номером семестру
            ksort($subjects);
            foreach ($subjects as $semester => $semesterSubjects) {
                echo "<h3>Номер семестру: $semester</h3>";
                foreach ($semesterSubjects as $subjectData) {
                    echo "<p>{$subjectData['subject']}</p>";
                    echo "<p>Кількість годин: {$subjectData['hours']}</p>";
                    echo "<p>Форма контролю: {$subjectData['assessment']}</p>";
                    echo "<p>Прізвище та ім'я лектора: {$subjectData['lecturer']}</p><br>";
                }
            }

            // Виведення кількості різних лекторів
            $numLecturers = count($lecturers);
            echo "<h3>Кількість різних лекторів: $numLecturers</h3>";
        } else {
            echo "Помилка читання файлу";
        }
    } else {
        echo "Файл не існує";
    }
}

// Виведення інформації про навчальні предмети
displaySubjects("data.txt");
?>
<h1 style='text-align:center;font-size: 24px;'><a href="index.php">Повернутися на головну сторінку</a></h1>