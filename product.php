
        <?php
            include 'connect.php';
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <div class="input-section">
        <form method="POST" class="product">
        <h1>Money tracker</h1>
        <div class="selection-list">
        <label for="category select">Category</label>
        <select id="category select" name="category">
            <option value="college fee">College fee</option>
            <option value="rent">rent</option>
            <option value="transport">Transport</option>
            <option value="food">Food</option>
            <option value="shopping">Shopping</option>
            <option value="shopping">Sports</option>
            <option value="cool drinks">Cool drink</option>
        </select>
        </div>
        <div class="selection-list">
        <label for="amount-input">Amount</label>
        <input type="number" id="amount-input" name="amount" required>
        </div>
        <div class="selection-list">
        <label for="date-input">Date</label>
        <input type="date" id="date-input" name="date" required>
        </div>
        <div class="selection-list">
        <button id="add-btn" type="submit" name="add">Add</button>
        </div>
        </form>
    </div>
    </div>
</body>
</html>

<?php
include 'connect.php';

if(isset($_POST['add'])){
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `spend`(`id`, `category`, `amount`, `date`) VALUES ('','$category','$amount','$date')";
    $data=mysqli_query($conn,$sql);
   
    if($data){
        ?>
        <script>
        alert("Added succesful");
        window.open('http://localhost/Expense-tracker/userdashboard.php',"_self");
    </script>
    <?php
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


