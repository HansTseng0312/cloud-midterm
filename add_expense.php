<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $amount = $_POST["amount"];

    $conn = new mysqli("a11111123-midterm.c5sscmgou5km.us-east-1.rds.amazonaws.com", "admin", "06010312", "expense_tracker");
    if ($conn->connect_error) {
        die("連接失敗：" . $conn->connect_error);
    }

    $sql = "INSERT INTO expenses (date, category, description, amount) VALUES ('$date', '$category', '$description', '$amount')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "新增失敗：" . $conn->error;
    }
    $conn->close();
}
?>
