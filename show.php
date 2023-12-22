<?php
if (isset($_GET['xh'])) {
    require_once 'dbconfig.php';
    $xh = $_GET['xh'];
    $sql = "SELECT * FROM score, student WHERE score.studentId=:xh AND score.studentId=student.studentId";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':xh', $xh, PDO::PARAM_STR);
    $stmt->execute();

    header("content-type:text/html;charset=utf-8");

    echo '<table class="table table-bordered">';
    echo "<thead>";
    echo "<tr>";
    echo "<th>学生</th>";
    echo "<th>科目</th>";
    echo "<th>成绩</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['mark'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}
?>
