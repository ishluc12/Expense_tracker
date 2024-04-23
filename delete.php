<?php
include 'connect.php';

$id=$_GET['id'];

$delete="DELETE FROM students WHERE id='$id' ";
$data=mysqli_query($conn, $delete);
if($data){
    ?>
    <script>
        alert("Are you sure you want delete deleted");
        window.open('http://localhost/study/display.php',"_self");
    </script>
    <?php
}

else{
    ?>
    <script>
        alert("Try again");
    </script>
    <?php  
}

?>