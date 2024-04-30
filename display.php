<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: darkblue;
        }
        .container{
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>LIST OF APPLICANTS</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Names</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connect.php';
                $sql = 'SELECT * FROM students';
                $data = mysqli_query($conn, $sql);
                $result = mysqli_num_rows($data);
                if ($result > 0) {
                    while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td><?php echo $row['stud_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td>
                                <a class="btn bg-primary px-3 text-decoration-none text-white" href="edit.php?id=<?php echo $row['stud_id']; ?>">Update</a>
                                <a class="btn bg-danger px-3 text-decoration-none text-white" onclick="return confirm('Are you sure you want to delete?')" href="delete.php?id=<?php echo $row['stud_id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    echo '<tr><td colspan="5">No records found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
