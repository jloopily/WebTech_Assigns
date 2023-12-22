<?php
require_once 'dbconfig.php';
header("content-type:text/html;charset=utf-8");

try {
    // 创建 PDO 连接
    $pdo = new PDO("mysql:host=$db[server];dbname=$db[database];port=$db[port]", $db['username'], $db['password']);
    
    // 设置 PDO 错误模式为异常
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 取表单数据
    $studentId = $_REQUEST['studentId'];
    $name = $_REQUEST['name'];
    $classname = $_REQUEST['className'];
    $birthday = $_REQUEST['birthday'];
    $sex = $_REQUEST['sex'];
    $nation = $_REQUEST['nation'];

    // 使用预处理语句插入数据
    $stmt = $pdo->prepare("INSERT INTO student(studentId, name, className, birthday, sex, nation) VALUES (:studentId, :name, :className, :birthday, :sex, :nation)");
    $stmt->bindParam(':studentId', $studentId, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':className', $classname, PDO::PARAM_STR);
    $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
    $stmt->bindParam(':sex', $sex, PDO::PARAM_STR);
    $stmt->bindParam(':nation', $nation, PDO::PARAM_STR);

    $stmt->execute();

    echo "<script>alert('插入学生信息成功！！！');parent.location.href='index.php';</script>";
} catch (PDOException $e) {
    echo "<script>alert('插入学生信息失败！！！');parent.location.href='index.php';</script>";
    // 可以在开发阶段打印错误信息，生产环境中应该关闭错误输出
    // echo "Error: " . $e->getMessage();
}
?>
