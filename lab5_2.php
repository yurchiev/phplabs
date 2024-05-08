<?php
// Параметри підключення до бази даних
$servername = "localhost:3306";
$username = "root";
$password = "admin";
$dbname = "labsphpschema";

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);
// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// Створення таблиці для зберігання предметів, якщо її ще не існує
$sql_create_table = "CREATE TABLE IF NOT EXISTS Subjects (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL,
    semester_number INT(2) NOT NULL,
    hours INT(3) NOT NULL,
    assessment_type VARCHAR(50) NOT NULL,
    lecturer_name VARCHAR(100) NOT NULL
)";
$conn->query($sql_create_table);

// Функція для додавання нового предмету до бази даних
function addSubjectToDB($conn, $subject_name, $semester_number, $hours, $assessment_type, $lecturer_name)
{
    $sql = "INSERT INTO Subjects (subject_name, semester_number, hours, assessment_type, lecturer_name)
            VALUES ('$subject_name', '$semester_number', '$hours', '$assessment_type', '$lecturer_name')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Функція для виведення всіх предметів з бази даних
function displaySubjectsFromDB($conn)
{
    $sql = "SELECT * FROM Subjects ORDER BY semester_number ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Виведення даних кожного предмету
        while ($row = $result->fetch_assoc()) {
            echo "<p>" . $row["subject_name"] . "</p>";
            echo "<p>Номер семестру: " . $row["semester_number"] . "</p>";
            echo "<p>Кількість годин: " . $row["hours"] . "</p>";
            echo "<p>Форма контролю: " . $row["assessment_type"] . "</p>";
            echo "<p>Прізвище та ім'я лектора: " . $row["lecturer_name"] . "</p><br>";
        }
    } else {
        echo "0 результатів";
    }
}

// Перевірка, чи була надіслана форма додавання нового предмету
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_name = $_POST["subject_name"];
    $semester_number = $_POST["semester_number"];
    $hours = $_POST["hours"];
    $assessment_type = $_POST["assessment_type"];
    $lecturer_name = $_POST["lecturer_name"];

    // Додавання нового предмету до бази даних
    if (addSubjectToDB($conn, $subject_name, $semester_number, $hours, $assessment_type, $lecturer_name)) {
        echo "Новий запис успішно додано до бази даних.";
    } else {
        echo "Помилка під час додавання запису.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Додати предмет</title>
</head>
<body>
<h2>Додати предмет</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Назва предмету: <input type="text" name="subject_name"><br><br>
    Номер семестру: <input type="number" name="semester_number"><br><br>
    Кількість годин: <input type="number" name="hours"><br><br>
    Форма контролю: <input type="text" name="assessment_type"><br><br>
    Прізвище та ім'я лектора: <input type="text" name="lecturer_name"><br><br>
    <input type="submit" name="submit" value="Додати предмет">
</form>

<h2>Предмети</h2>
<?php displaySubjectsFromDB($conn); ?>
<h1 style='text-align:center;font-size: 24px;'><a href="index.php">Повернутися на головну сторінку</a></h1>
</body>
</html>
