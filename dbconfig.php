<?php
$db = array(
    'server' => 'localhost',
    'port' => '3306',
    'username' => 'root',
    'password' => '123456',
    'database' => 'db_student'
);

try {
    // 使用PDO连接数据库，注意用户名和密码在这里传递
    $conn = new PDO("mysql:host={$db['server']};port={$db['port']};dbname={$db['database']}", $db['username'], $db['password']);

    // 设置PDO错误模式为异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 声明字符集
    $conn->exec('SET NAMES utf8');
} catch (PDOException $e) {
    echo "连接失败: " . $e->getMessage();
    exit();
}
?>
