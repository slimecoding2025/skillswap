<?php
session_start();
// التحقق من أن المستخدم مسجل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'skillswap');
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// جلب بيانات المستخدم
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>مرحباً، <?php echo $user['username']; ?>!</h1>
        <h2>مهاراتك:</h2>
        <p><?php echo $user['skills']; ?></p>

        <h2>عرض التبادلات المتاحة:</h2>
        <?php
        // جلب التبادلات المتاحة
        $sql = "SELECT * FROM exchanges WHERE status = 'pending'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='exchange'>";
                echo "<p>المستخدم: " . $row['user_id'] . "</p>";
                echo "<p>المهارة المعروضة: " . $row['skill_offered'] . "</p>";
                echo "<p>المهارة المطلوبة: " . $row['skill_wanted'] . "</p>";
                echo "<button onclick='acceptExchange(" . $row['id'] . ")'>قبول التبادل</button>";
                echo "</div>";
            }
        } else {
            echo "<p>لا توجد تبادلات متاحة حالياً.</p>";
        }
        ?>
    </div>

    <script>
        function acceptExchange(exchangeId) {
            if (confirm("هل أنت متأكد من قبول هذا التبادل؟")) {
                window.location.href = "accept_exchange.php?exchange_id=" + exchangeId;
            }
        }
    </script>
</body>
</html>