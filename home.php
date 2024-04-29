<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
            width: 430px;
            height: 250px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="#" method="POST">
            <h2>loginform</h2>
        <div class="input">
            <label>name</label>
            <input type="text" name="name">
        </div>
        <div class="input">
            <label>emial</label>
            <input type="email" name="email">
        </div>
        <div class="input">
            <label>password</label>
            <input type="passwor" name="password">
        </div>
        
    <button type="submit" name="send"> login</button>
    <a href="#">Register</a>
    </form>
</body>
</html>

<?php
include("connect.php");

if(isset($_POST["send"])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = mysqli_query($conn,"SELECT stud_id FROM students WHERE name='$name' AND email='$email' AND password='$password'");
    $result = mysqli_fetch_array($sql);
    if($result>0){
    $_SESSION['sid']=$result['stud_id'];
        
        ?>
        <script type="text/javascript">
            alert("login successfl");
            window.open("http://localhost/Expense-tracker/userdashboard.php", "_self");
        </script>
        <?php
    } else {
        echo "Wrong credentials";
    }
}
?>
