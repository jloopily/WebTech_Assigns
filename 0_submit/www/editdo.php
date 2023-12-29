<?php
require_once 'dbconfig.php';
header("content-type:text/html;charset=utf-8");

// 取表单数据
$id = $_REQUEST['id'];
$studentId = $_REQUEST['studentId'];
$name = $_REQUEST['name'];
$className = $_REQUEST['className'];
$birthday = $_REQUEST['birthday'];
$sex = $_REQUEST['sex'];
$nation = $_REQUEST['nation'];

try {
    // 使用 PDO 连接数据库
    $conn = new PDO("mysql:host=$db[server];dbname=$db[database];port=$db[port]", $db['username'], $db['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 使用预处理语句更新数据
    $stmt = $conn->prepare("UPDATE student SET studentId=?, name=?, className=?, birthday=?, sex=?, nation=? WHERE id=?");
    $stmt->bindParam(1, $studentId, PDO::PARAM_STR);
    $stmt->bindParam(2, $name, PDO::PARAM_STR);
    $stmt->bindParam(3, $className, PDO::PARAM_STR);
    $stmt->bindParam(4, $birthday, PDO::PARAM_STR);
    $stmt->bindParam(5, $sex, PDO::PARAM_STR);
    $stmt->bindParam(6, $nation, PDO::PARAM_STR);
    $stmt->bindParam(7, $id, PDO::PARAM_INT);

    $stmt->execute();

    echo "<script>alert('修改成功！！！');parent.location.href='index.php';</script>";
} catch (PDOException $e) {
    echo "<script>alert('修改失败！！！');parent.location.href='index.php';</script>";
    // 输出错误信息，实际应用时应该记录到日志中而不是直接输出给用户
    echo "Error: " . $e->getMessage();
}

// 关闭数据库连接
$conn = null;
?>
