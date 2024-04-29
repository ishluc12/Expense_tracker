<?php
include 'connect.php';
$id=$_GET['id'];
$select="SELECT * FROM students WHERE stud_id='$id'";
$data=mysqli_query($conn,$select);
$row=mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>
<body>
<div class="container">
        <form action="register.php" method="POST">
            <h2>Edit user</h2>
            <div class="input">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="input">
                <label>Phone</label>
                <input type="text" name="phone" required>
            </div>
        
            <button type="submit" name="update">Update</button>
            <a href="display.php">Back</a>
        </form>
    </div>

    <?php
        if(isset($_POST["update"])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $salary= $_POST['salary'];
            $password = $_POST['password'];

            $sql='UPDATE students SET name=$name,email="$email",phone="$phone" WHERE stud_id="$id" ';
            $data=mysqli_query($conn,$sql);
            if($data){
                ?>
                <script type="text/javascript">
                    alert('Data chsnged successful');
                    window.open('http://localhost/Expense-tracker/dashboard.php', "_self");
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
