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
            height: 400px;
            padding: 20px;
            flex-direction: column; /* Added */
        }
        .input {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="register.php" method="POST" enctype="multipart/form-data"> <!-- Added enctype attribute -->
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
                <label>Salary</label>
                <input type="number" name="salary" required>
            </div>
            <div class="input">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="input">
                <label for="imageFile">Picture</label>
                <input type="file" id="imageFile" name="image" required accept="image/jpeg,image/png">
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
        $salary = $_POST['salary'];
        $password = $_POST['password'];
      
        // Check if an image is uploaded
        if (isset($_FILES['image'])) {
            $imageFile = $_FILES['image'];

            // File upload logic
            $allowedExtensions = array('jpg', 'jpeg', 'png');
            $fileExtension = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
            if (!in_array($fileExtension, $allowedExtensions)) {
                die('Invalid file type. Please upload a JPEG or PNG image.');
            }

            $newFilename = uniqid('', true) . '.' . $fileExtension;
            $destination = 'uploads/' . $newFilename;
            if (move_uploaded_file($imageFile['tmp_name'], $image)) {
                echo 'Image uploaded successfully!';
            } else {
                echo 'Failed to upload image.';
            }
        }

        // Prepare and execute SQL query to insert data into 'students' table
        $sql = "INSERT INTO students (name, email, phone, salary, password, image) VALUES ('$name', '$email', '$phone', $salary, '$password', '$newFilename')"; // Assuming 'image' is the column name in your database
        
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
</body>
</html>
