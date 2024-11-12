<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn = new mysqli("localhost", "root", "", "expense_tracker");
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
