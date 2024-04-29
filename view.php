<?php
include 'connect.php ';
?>
<table>
<tr>
<th>Category</th>
<th>Amount</th>
<th>Date</th>
<th>Action</th>
</tr>
<?php
$sql='SELECT * FROM spend';
$data=mysqli_query($conn, $sql);
$result=mysqli_num_rows($data);
if($result>0){
    while($row=mysqli_fetch_array($data)){
        ?>
        <tr>
           
            <td><?php echo $row ['category'];?></td>
            <td><?php echo $row ['amount'];?></td>
            <td><?php echo $row ['date'];?></td>
            <td><a href="update.php?=id<?php echo $row['id'];?>">Update</a></td>
            <td><a href="erase.php?=id<?php echo $row['id'];?>">Delete</a></td>
            <td><a href="product.php?=id<?php echo $row['id'];?>">Product</a></td>
            
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



