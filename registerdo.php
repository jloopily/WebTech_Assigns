<?php
require_once 'dbconfig.php';
header("content-type:text/html;charset=utf-8");

//取表单数据
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$password2 = sha1($password);

$sql = "INSERT INTO user (id, username, password, status) VALUES (null, '$username', '$password2', 1)";

// Create connection
$conn = new mysqli($db['server'], $db['username'], $db['password'], $db['database']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('注册成功！去登录');parent.location.href='login.php';</script>";
} else {
    echo "<script>alert('注册失败！！');parent.location.href='register.php';</script>";
}

$conn->close();
?>
