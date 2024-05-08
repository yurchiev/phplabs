<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Предмети та викладачі</title>
</head>
<body>
<?php
// Підключення до бази даних MySQL
$servername = "localhost:3306";
$username = "root";
$password = "admin";
$dbname = "labsphpschema";

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Клас для взаємодії з базою даних
class Subject {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Отримати інформацію про всі предмети, що читаються в заданому семестрі
    public function getBySemester($semester_number) {
        $stmt = $this->conn->prepare("SELECT * FROM Subjects WHERE semester_number = ?");
        $stmt->bind_param("i", $semester_number);
        $stmt->execute();
        $result = $stmt->get_result();
        $subjects = [];
        while ($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
        $stmt->close();
        return $subjects;
    }
}

// Створення об'єкту класу Subject
$subject = new Subject($conn);

// Обробка вибору семестру
$selected_semester = isset($_POST['semester']) ? $_POST['semester'] : 1;

// Приклад використання класу
$subjects_in_semester = $subject->getBySemester($selected_semester);

// Відображення форми вибору семестру
echo "<form method='post'>";
echo "<label for='semester'>Оберіть семестр:</label>";
echo "<select name='semester' id='semester'>";
for ($i = 1; $i <= 6; $i++) {
    echo "<option value='$i' ";
    if ($selected_semester == $i) {
        echo "selected";
    }
    echo ">Семестр $i</option>";
}
echo "</select>";
echo "<input type='submit' value='Показати'>";
echo "</form>";

// Відображення результатів на сторінці
if (!empty($subjects_in_semester)) {
    $unique_subjects = []; // Масив для зберігання унікальних предметів
    echo "<h2>Предмети, що читаються у семестрі $selected_semester:</h2>";
    foreach ($subjects_in_semester as $subject) {
        $subject_name = $subject['subject_name'];
        // Перевірка наявності предмету в масиві
        if (!in_array($subject_name, $unique_subjects)) {
            echo "<p>Предмет: $subject_name</p>";
            echo "<p>Семестр: " . $subject['semester_number'] . "</p>";
            echo "<p>Години: " . $subject['hours'] . "</p>";
            echo "<p>Тип оцінювання: " . $subject['assessment_type'] . "</p>";

            // Використання ідентифікатора викладача для отримання інформації про викладача
            $lecturer_id = $subject['lecturer_id'];
            $lecturer_query = $conn->query("SELECT lecturer_name FROM Lecturers WHERE id = $lecturer_id");
            if ($lecturer_query && $lecturer_query->num_rows > 0) {
                $lecturer_data = $lecturer_query->fetch_assoc();
                echo "<p>Викладач: " . $lecturer_data['lecturer_name'] . "</p>";
            } else {
                echo "<p>Інформація про викладача відсутня.</p>";
            }

            echo "<hr>";
            // Додавання предмету до масиву унікальних предметів
            $unique_subjects[] = $subject_name;
        }
    }
} else {
    echo "<p>Предмети для цього семестру не знайдено.</p>";
}

// Закриття з'єднання з базою даних
$conn->close();
?>
</body>
<h1 style='text-align:center;font-size: 24px;'><a href="index.php">Повернутися на головну сторінку</a></h1>
</html>
