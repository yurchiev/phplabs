
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

// Запит для виведення навчальних предметів впорядкованих за зростанням номерів семестрів та кількістю різних лекторів
$sql_subjects = "SELECT subject_name, semester_number, COUNT(DISTINCT lecturer_name) AS unique_lecturers
        FROM Subjects
        GROUP BY subject_name, semester_number
        ORDER BY semester_number ASC";

$result_subjects = $conn->query($sql_subjects);

// Запит для підрахунку загальної кількості різних лекторів на усіх предметах
$sql_total_lecturers = "SELECT COUNT(DISTINCT lecturer_name) AS total_lecturers FROM Subjects";
$result_total_lecturers = $conn->query($sql_total_lecturers);
$row_total_lecturers = $result_total_lecturers->fetch_assoc();
$total_lecturers = $row_total_lecturers["total_lecturers"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Навчальні предмети</title>
</head>
<body>
<h2>Навчальні предмети</h2>
<table border="1">
    <tr>
        <th>Назва предмету</th>
        <th>Номер семестру</th>
        <th>Кількість різних лекторів</th>
    </tr>
    <?php
    // Виведення результатів запиту
    if ($result_subjects->num_rows > 0) {
        while ($row = $result_subjects->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["subject_name"] . "</td>";
            echo "<td>" . $row["semester_number"] . "</td>";
            echo "<td>" . $row["unique_lecturers"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Немає даних</td></tr>";
    }
    ?>
</table>

<p>Загальна кількість різних лекторів на усіх предметах: <?php echo $total_lecturers; ?></p>
</body>
</html>

<?php
// Закриття підключення до бази даних
$conn->close();
?>
<h1 style='text-align:center;font-size: 24px;'><a href="index.php">Повернутися на головну сторінку</a></h1>
