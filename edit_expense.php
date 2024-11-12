<?php
$conn = new mysqli("localhost", "root", "", "expense_tracker");
if ($conn->connect_error) {
    die("連接失敗：" . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM expenses WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $date = $_POST["date"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $amount = $_POST["amount"];
    
    $sql = "UPDATE expenses SET date='$date', category='$category', description='$description', amount='$amount' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "更新失敗：" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>修改記帳資料</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>修改記帳資料</h2>
    <form action="edit_expense.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>日期：</label>
        <input type="date" name="date" value="<?php echo $row['date']; ?>" required>
        
        <label>類別：</label>
        <input type="text" name="category" value="<?php echo $row['category']; ?>" required>
        
        <label>描述：</label>
        <input type="text" name="description" value="<?php echo $row['description']; ?>">
        
        <label>金額：</label>
        <input type="number" step="0.01" name="amount" value="<?php echo $row['amount']; ?>" required>
        
        <button type="submit">更新</button>
    </form>
</body>
</html>
