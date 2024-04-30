        <?php
        include("connect.php");
        session_start();
        if (!isset($_SESSION['sid']) || empty($_SESSION['sid'])) {
            header("Location: index.php");
            exit(); 
        }
        $userId = $_SESSION['sid'];

        // Calculate total amount spent by the user
        $sql = 'SELECT SUM(amount) AS total_spent FROM spend';
        $result = $conn->query($sql);
        if ($result === false) {
            echo "Error executing query: " . $conn->error;
            exit();
        }
        $row = $result->fetch_assoc();
        $totalSpent = isset($row['total_spent']) ? $row['total_spent'] : 0;

        // Retrieve user's initial salary
        $userSalaryQuery = mysqli_query($conn, "SELECT salary FROM students WHERE stud_id='$userId'");
        $userSalaryData = mysqli_fetch_assoc($userSalaryQuery);
        $userSalary = isset($userSalaryData['salary']) ? $userSalaryData['salary'] : 0;

        // Calculate remaining salary
        $remainingSalary = $userSalary - $totalSpent;

        ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <aside class="siddebar" id="sidebar">
            <div class="d-flex">
                <button type="button" id="toggle-btn">
                <i class="fas fa-th"></i>
                </button>
                <div class="sidebar-logo">
                   <a href="#">Dashbord</a>
                </div>
            </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                <i class="fas fa-user"></i>
                <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                <i class="fas fa-tasks"></i>
                <span>Task</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" 
                  data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                     <i class="fas fa-shield-alt"></i>
                      <span>Auth</span>
                  </a>
                <ul class="sidebardropdown list-unstyled collapse" data-bs-parent="#sidebar" id="auth">
                    <li class="sidebar-items">
                    <a href="#" class="sidebar-link">Login</a>
                    </li>
                    <li class="sidebar-items">
                     <a href="#" class="sidebar-link">Register</a>
                     </li>
                </ul>
            </li>
            
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" 
                  data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                  <i class="fas fa-cog"></i>
                      <span>settings</span>
                  </a>
                <ul class="sidebardropdown list-unstyled collapse" data-bs-parent="#sidebar" id="auth">
                    <li class="sidebar-items">
                    <a href="backup.php" class="sidebar-link">Recover data</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="index.php" class="sidebar-link">
            <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                    ...
        <form action="#" method="GET" class="d-none d-sm-inline-block">
            <div class="input-group input-group-navbar">
                <input type="text" name="search" class="form-control border-0 rounded-0" placeholder="Search...">
                <button class="btn border-0 round-0" type="submit">Search</button>
            </div>
            </form>
            ...

            <?php
                
                if(isset($_GET['search'])) {
                    
                    $search = $_GET['search'];

                    $sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR salary LIKE '%$search%'";
                    $result = $conn->query($sql);

                    
                    if ($result->num_rows > 0) {
                      
                        while($row = $result->fetch_assoc()) {
                           
                        }
                    } else {
                        
                        echo 'No records found';
                    }
                }
            ?>


               <div class="navbar-collapse collapse">
                <?php
                $id=$_SESSION['sid'];
                $sel=mysqli_query($conn,"SELECT * FROM admin WHERE id='$id'");
                while($row=mysqli_fetch_array($sel)){   
                ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                    <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                            <img src="images.png" class="avatar img-fluid" alt="user">
                        </a>
                       
                            <br>
                            <h1> <?php echo $row['username'] ?> </h1>

                 <?php
                }
                ?>
               
                        <div class="dropdown-menu dropdown-menu-end rounded">
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-clock"></i>
                                <span>Analytics</span>
                            </a>
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                                <span>Setting</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                            <i class="fas fa-question-circle"></i>
                                <span>Analytics</span>
                            </a>
                        </div>
                    </li>
                </ul>
               </div>

            </nav>
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


                ?>

            <main class="content px-3 py-4">
    <div class="container-fluid">
        <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Admin dashboard</h3>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card border-0">
                        <div class="card-body py-4">
                            <h5 class="mb-2 fw-bold">
                                Members <i class="fas fa-users"></i>
                            </h5>
                            <p class="mb-2 fw-bold">
                                <?php
                                $students = "students";
                                $sql = "SELECT COUNT(*) as total FROM $students";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $totalRecord = $row['total'];
                                    echo '<h3>Total Participants: ' . $totalRecord . '</h3>';
                                } 
                                ?>
                            </p>
                        </div>
                        <div class="mb-0">
                        <?php
// Current value
                            $currentValue = 100;

                            
                            $previousValue = 90;

                           
                            $percentageChange = (($currentValue - $previousValue) / $previousValue) * 100;

                            
                            echo '<div class="mb-0">';
                            echo '<span class="badge text-success me-2">+' . number_format($percentageChange, 2) . '%</span>';
                            echo '</div>';
                        ?>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
             <div class="card border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                            Total salary<i class="fas fa-coins"></i>

                        </h5>
                        <p class="mb-2 fw-bold">
                            <?php
                            $totalSalary = 0;
                            $totalStudents = 0;

                            $sql = 'SELECT * FROM students';
                            $data = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($data) > 0) {
                                while ($row = mysqli_fetch_array($data)) {
                                    $totalSalary += $row['salary'];
                                    $totalStudents++;
                                }
                            }

                            echo '' . number_format($totalSalary, 2);
                            ?>
                        </p>
                    </div>
                    <div class="mb-0">
                        <?php
                        
                        if ($totalStudents > 0) {
                            $averageSalary = $totalSalary / $totalStudents;

                            echo '<span class="badge text-success me-2">Average: ' . number_format($averageSalary, 2) . '</span>';
                        } else {
                            echo '<span class="badge text-danger">No students found</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>

                <div class="col-12 col-md-4">
                    <div class="card border-0">
                        <div class="card-body py-4">
                            <h5 class="mb-2 fw-bold">
                                Members progress
                            </h5>
                            <?php
                                $sql = 'SELECT SUM(amount) AS total_spent FROM spend';
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $totalSpent = $row['total_spent'];

                                $remainingSalary = $totalSalary - $totalSpent;
                            ?>
                                <p class="mb-2 fw-bold">
                                    <?php echo '$' . number_format($remainingSalary, 2); ?>
                                </p>

                        </div>
                        
                    </div>
                </div>
            </div>
            <h3 class="fw-bold fs-4 my-3">Clients list <a href="display.php" class="btn btn-primary px-3 text-white">view</a></h3>
            <div class="row">
                <div class="col-12">
                <?php
                       
                        ?>
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
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
                                            <td><?php echo $row['salary']; ?></td>
                                            <td>
                                                <a class="btn btn-success px-3 text-white" href="edit.php?id=<?php echo $row['stud_id']; ?>">Update</a>
                                                <a class="btn btn-danger px-3 text-white" onclick="return confirm('Are you sure you want to delete?')" href="delete.php?id=<?php echo $row['stud_id']; ?>">Delete</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No records found</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start">
                            <a href="#" class="text-body-secondary">
                                <strong>Expense Tracker</strong>
                            </a>
                            <div class="col-6 text-end text-body-secondary d-none d-md-block">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">
                                        <i class="fas fa-phone"></i>    
                                        Contact</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">
                                        <i class="fas fa-info-circle about-icon"></i>    
                                        About us</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">Termst & condition</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <script src="script.js">
        function searchUsers() {
  var searchTerm = document.getElementById("searchInput").value.toLowerCase();
  var tableBody = document.querySelector(".table tbody");
  var rows = tableBody.querySelectorAll("tr");

  for (var i = 0; i < rows.length; i++) {
    var row = rows[i];
    var nameCell = row.querySelector("td:nth-child(2)"); // Adjust selector based on your name column
    var emailCell = row.querySelector("td:nth-child(3)"); // Adjust selector based on your email column
    var textContent = nameCell.textContent.toLowerCase() + emailCell.textContent.toLowerCase();
    if (textContent.indexOf(searchTerm) !== -1) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  }
}
    </script>
</body>
</html>

<?php
        
?>