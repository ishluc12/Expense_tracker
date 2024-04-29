<?php
   
    include("connect.php");

   
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
     
        $backupFileName = 'user_backup_' . date('Y-m-d') . '.csv';

        $backupFile = fopen($backupFileName, 'w');

        
        fputcsv($backupFile, array('ID', 'Name', 'Email', 'Phone', 'Salary'));

        
        while ($row = $result->fetch_assoc()) {
            
            fputcsv($backupFile, $row);
        }

      
        fclose($backupFile);

        
        echo '<a href="' . $backupFileName . '">Download Backup</a>';
    } else {
       
        echo 'No records found to backup';
    }

    $conn->close();
?>
