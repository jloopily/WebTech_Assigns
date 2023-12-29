<?php
header("content-type:text/html;charset=utf-8");

session_start();
if (!isset($_SESSION['userName'])) {
    header("location:login.php");
} else {
    $id = $_REQUEST['id'];
    require_once 'dbconfig.php';

    try {
        // 创建 PDO 连接
        $pdo = new PDO("mysql:host=$db[server];dbname=$db[database];port=$db[port]", $db['username'], $db['password']);
        
        // 设置 PDO 错误模式为异常
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 删除语句
        $sql = "DELETE FROM student WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>alert('删除成功!');parent.location.href='index.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('删除失败!');parent.location.href='index.php';</script>";
        // 可以在开发阶段打印错误信息，生产环境中应该关闭错误输出
        // echo "Error: " . $e->getMessage();
    }
}
?>
