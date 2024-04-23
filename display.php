<?php
include 'connect.php ';
?>
<table>
<tr>
<th>Names</th>
<th>Email</th>
<th>Phone</th>
<th>Action</th>

</tr>
<?php
$sql='SELECT * FROM students';
$data=mysqli_query($conn, $sql);
$result=mysqli_num_rows($data);
if($result>0){
    while($row=mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $row ['name'];?></td>
            <td><?php echo $row ['email'];?></td>
            <td><?php echo $row ['phone'];?></td>
            <td><a href="connect.php?=id<?php echo $row['id'];?>">Edit</a></td>
            <td><a href="connect.php?=id<?php echo $row['id'];?>">Delete</a></td>
            
        </tr>
        <?php
    } 
        }
        else {
            ?>
        echo 'no record found';
        <?php
    }


?>
</table>



