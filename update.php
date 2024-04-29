<?php
include 'connect.php';
$id=$_GET['id'];
$select="SELECT * FROM spend WHERE username='$username'";
$data=mysqli_query($conn,$select);
$row=mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
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
            <option value="college fee"></option>
            <option value="rent">rent</option>
            <option value="transport">Transport</option>
            <option value="food">Food</option>
            <option value="shopping">Shopping</option>
            <option value="cool drinks">Cool drink</option>
        </select>
        </div>
        <div class="selection-list">
        <label for="amount-input">Amount</label>
        <input type="number" id="amount-input" name="amount">
        </div>
        <div class="selection-list">
        <label for="date-input">Date</label>
        <input type="date" id="date-input">
        </div>
        <div class="selection-list">
        <button id="add-btn" type="submit" name="update">Update</button>
        </div>
        </form>
    </div>
    </div>

    <?php
        if(isset($_POST["update"])){
            $category = $_POST['category'];
            $amount = $_POST['amount'];
            $date= date('Y-m-d H:i:s');

            $sql="UPDATE spend SET category='$category',amount='$amount' WHERE id='$id' ";
            $result=mysqli_query($conn,$sql);
            if($result){
                ?>
                <script type="text/javascript">
                    alert('Data chsnged successful');
                    window.open('http://localhost/Expense-tracker/userdashboard.php',"_self");
                </script>
                <?php
            } else{
                ?>
                 <script type="text/javascript">
                    alert('try again');
                    
                </script>
                <?php

        }
    }
    ?>
</body>

</html>
