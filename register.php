<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'skillswap');

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// جمع البيانات من النموذج
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // تشفير كلمة المرور

// إدخال البيانات في قاعدة البيانات
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "تم التسجيل بنجاح!";
} else {
    echo "خطأ: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>