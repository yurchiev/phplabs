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

// Зчитуємо символи з форми, якщо вони були введені
$search_string = isset($_GET["search_string"]) ? $_GET["search_string"] : '';

if ($search_string) {
    // Запит для виведення навчальних предметів, назви яких містять задані символи
    $sql = "SELECT * FROM Subjects WHERE subject_name LIKE '%$search_string%'";
    $result = $conn->query($sql);
}
?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Пошук навчальних предметів</title>
    </head>
    <body>
    <h2>Пошук навчальних предметів</h2>
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="search_string">Введіть символи для пошуку:</label>
        <input type="text" id="search_string" name="search_string">
        <input type="submit" value="Пошук">
    </form>

    <h3>Результати пошуку:</h3>
    <?php if ($search_string && $result->num_rows > 0) { ?>
        <ul>
            <?php
            // Виведення результатів пошуку
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row["subject_name"] . "</li>";
            }
            ?>
        </ul>
    <?php } elseif ($search_string) { ?>
        <p>Нічого не знайдено</p>
    <?php } ?>
    </body>
    </html>

<?php
// Закриття підключення до бази даних
$conn->close();
?>
<h1 style='text-align:center;font-size: 24px;'><a href="index.php">Повернутися на головну сторінку</a></h1>
