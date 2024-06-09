<?php
$servername = "localhost:3306";
$username = "root";
$password = "admin";
$dbname = "taras_shevchenko_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Fetch biography content
$sql = "SELECT title, content FROM biography WHERE id = 1";
$result = $conn->query($sql);

$title = "";
$content = "";

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $title = $row["title"];
        $content = $row["content"];
    }
} else {
    echo "0 результатів";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #50b3a2;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            padding: 0;
            list-style: none;
        }
        header li {
            float: left;
            display: inline;
            padding: 0 20px 0 20px;
        }
        header #branding {
            float: left;
        }
        header #branding h1 {
            margin: 0;
        }
        header nav {
            float: right;
            margin-top: 10px;
        }
        #showcase {
            min-height: 400px;
            background: url('images/shevchenko.jpg') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            text-align: center;
            color: #fff;
        }
        #showcase h1 {
            margin-top: 100px;
            font-size: 55px;
            margin-bottom: 10px;
        }
        #showcase p {
            font-size: 20px;
        }
        article {
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div id="branding">
            <h1>Тарас Шевченко</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Головна</a></li>
                <li><a href="about.php">Про нас</a></li>
                <li><a href="contact.php">Контакти</a></li>
            </ul>
        </nav>
    </div>
</header>
<section id="showcase">
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <p><?php echo $content; ?></p>
    </div>
</section>
<div class="container">
    <article>
        <h2><?php echo $title; ?></h2>
        <p><?php echo $content; ?></p>
    </article>
</div>
</body>
</html>
