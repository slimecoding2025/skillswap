<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill = $_POST['skill'];
    $user_id = $_SESSION['user_id'];

    $conn = new mysqli('localhost', 'root', '', 'skillswap');
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET skills = CONCAT(IFNULL(skills, ''), '$skill, ') WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "تمت إضافة المهارة بنجاح!";
    } else {
        echo "خطأ: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مهارة</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>إضافة مهارة جديدة</h1>
        <form action="add_skill.php" method="POST">
            <input type="text" name="skill" placeholder="المهارة" required>
            <button type="submit">إضافة</button>
        </form>
    </div>
</body>
</html>