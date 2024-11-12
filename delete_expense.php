<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn = new mysqli("a11111123-midterm.c5sscmgou5km.us-east-1.rds.amazonaws.com", "admin", "06010312", "expense_tracker");
    if ($conn->connect_error) {
        die("連接失敗：" . $conn->connect_error);
    }

    $sql = "DELETE FROM expenses WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "刪除失敗：" . $conn->error;
    }
    $conn->close();
}
?>
