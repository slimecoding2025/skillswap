<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if (isset($_GET['exchange_id'])) {
    $exchange_id = $_GET['exchange_id'];

    $conn = new mysqli('localhost', 'root', '', 'skillswap');
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    $sql = "UPDATE exchanges SET status = 'completed' WHERE id = $exchange_id";
    if ($conn->query($sql) === TRUE) {
        echo "تم قبول التبادل بنجاح!";
    } else {
        echo "خطأ: " . $conn->error;
    }

    $conn->close();
}
?>