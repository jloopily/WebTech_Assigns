<?php
header("content-type:text/html;charset=utf-8");

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['userName'])) {
    header("location:index.php");
} elseif (!isset($_POST['username'])) {
    header("location:login.php");
} else {
    $username = $_POST['username'];
    $passcode = $_POST['passcode'];
    $yz = $_POST['code'];
    $code = $_SESSION["code"];
    $password2 = sha1($passcode);

    require_once 'dbconfig.php';

    // Create connection
    $conn = new mysqli($db['server'], $db['username'], $db['password'], $db['database']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user WHERE username= ?";
    
    // 使用预处理语句
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            if ($yz == $code) {
                // 验证密码
                if (sha1($passcode) == $row['password']) {
                    $_SESSION['userName'] = $username;
                    echo "<script>alert('登录成功！');parent.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('密码错误！');parent.location.href='login.php';</script>";
                }
            } else {
                echo "<script>alert('验证码错误！');parent.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('用户名不存在！');parent.location.href='login.php';</script>";
        }

        // 关闭预处理语句
        $stmt->close();
    }

    // 关闭连接
    $conn->close();
}
?>
