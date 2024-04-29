<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <form method="POST">
            <div class="input-data">
             <label>Username</label>
             <input type="text" name="username" autocomplete="no">
            </div>

            <div class="input-data">
             <label>Email</label>
             <input type="email" name="email" autocomplete="no">
            </div>

            <div class="input-data">
             <label>Phone</label>
             <input type="number" name="phone" autocomplete="no">
            </div>

            <div class="input-data">
             <label>Passwword</label>
             <input type="password" name="password" autocomplete="no">
            </div>
            <button type="submit" name="sub">Register</button>
            <a href="adminlogin.php">Login</a>
            </form>
        </div>
    </div>
</body>
</html>

    <?php
  
    include("connect.php");

  
    if(isset($_POST["sub"])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $sql = "INSERT INTO admin  (username, email,phone,password) VALUES ('','$username','$email','$phone','$password')";
        
        if($conn->query($sql) === TRUE){
            ?>
            <script type="text/javascript">
                alert("Registered successful");
              
            </script>
            <?php

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

