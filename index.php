<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記帳系統</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>記帳系統</h1>
    
    <!-- 新增記帳表單 -->
    <form action="add_expense.php" method="post">
        <label>日期：</label>
        <input type="date" name="date" required>
        
        <label>類別：</label>
        <input type="text" name="category" required>
        
        <label>描述：</label>
        <input type="text" name="description">
        
        <label>金額：</label>
        <input type="number" step="0.01" name="amount" required>
        
        <button type="submit">新增</button>
    </form>
    
    <!-- 顯示記帳資料 -->
    <table>
        <tr>
            <th>日期</th>
            <th>類別</th>
            <th>描述</th>
            <th>金額</th>
            <th>操作</th>
        </tr>
        <?php
        // 連接資料庫
        $conn = new mysqli("a11111123-midterm.c5sscmgou5km.us-east-1.rds.amazonaws.com", "admin", "06010312", "expense_tracker");
        if ($conn->connect_error) {
            die("連接失敗：" . $conn->connect_error);
        }

        // 查詢所有記帳資料
        $sql = "SELECT * FROM expenses";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["amount"] . "</td>";
                echo "<td>
                        <a href='edit_expense.php?id=" . $row["id"] . "'>修改</a> |
                        <a href='delete_expense.php?id=" . $row["id"] . "' onclick='return confirm(\"確定要刪除嗎？\");'>刪除</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>目前沒有記帳資料</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
