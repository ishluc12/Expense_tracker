<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
            width: 430px;
            height: 300px;
            padding: 20px;
        }
        .input {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="register.php" method="POST">
            <h2>Registration Form</h2>
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
            <div class="input">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="send">Register</button>
            <a href="index.php">Login</a>
        </form>
    </div>

    <?php
    // Include the database connection
    include("connect.php");

    // Check if the form is submitted
    if(isset($_POST["send"])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Prepare and execute SQL query to insert data into 'students' table
        $sql = "INSERT INTO students (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
        
        if($conn->query($sql) === TRUE){
            echo "Registration successful";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
