<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spending Calculator</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
       body {
            background-color: #1d6efd;
        }

        .text-light {
            color: #fff;
        }

        .bg-dark {
            background-color: #343a40 !important;
        }

        .container {
            display: block; /* Reset display property */
            padding: 20px; /* Add padding */
        }

        .summary, .table-responsive {
            max-width: 600px; /* Limit maximum width */
            margin: 0 auto; /* Center align */
        }

        .summary {
            padding: 10px;
            font-size: 16px; /* Adjust font size */
        }

        .table {
            font-size: 14px; /* Adjust font size */
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        include("connect.php");

        $totalSpendingQuery = "SELECT SUM(amount) AS total_spending FROM spend";
        $totalSpendingResult = $conn->query($totalSpendingQuery);
        $totalSpendingRow = $totalSpendingResult->fetch_assoc();
        $totalSpending = $totalSpendingRow['total_spending'];

        $avgSpendingQuery = "SELECT AVG(amount) AS avg_spending FROM spend";
        $avgSpendingResult = $conn->query($avgSpendingQuery);
        $avgSpendingRow = $avgSpendingResult->fetch_assoc();
        $avgSpending = $avgSpendingRow['avg_spending'];

        $categorySpendingQuery = "SELECT category, SUM(amount) AS total_spending FROM spend GROUP BY category";
        $categorySpendingResult = $conn->query($categorySpendingQuery);

        echo "</div>";

        echo "<h2 class='text-center text-white'>Spending by Category</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th>Category</th>";
        echo "<th>Total Spending</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $categorySpendingResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . number_format($row['total_spending'], 2) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        
        echo "<h1 class='text-center mt-5 text-white'>Spending Calculation</h1>";
        echo "<div class='summary bg-light p-3 mb-5'>";
        echo "<p class='mb-2'>Total Spending: <span class='fw-bold'>" . number_format($totalSpending, 2) . "</span></p>";
        echo "<p class='mb-2'>Average Spending: <span class='fw-bold'>" . number_format($avgSpending, 2) . "</span></p>";

        $conn->close();
        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
