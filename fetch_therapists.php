<!DOCTYPE html>
<html>
<head>
  <title>Details Page</title>
  <style>
    /* Reset some default browser styles */
body, h1 {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    text-align: center;
}

h1 {
    background-color: #007bff;
    color: white;
    padding: 20px 0;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 10px;
    text-align: left;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

.no-results {
    font-weight: bold;
    margin: 20px;
    color: #333;
}

  </style>
</head>
<body>
<div class="container">
    <div class="details-container">
      <div class="title">Therapist Details</div>
<?php
// Database connection
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "therapist";

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$area = $_POST['area'];
$city = $_POST['city'];

// SQL query to fetch therapists based on city and area
$sql = "SELECT * FROM thera WHERE area = '$area' AND city = '$city'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<html><head><title>Therapists</title></head><body>";
    echo "<h1>Therapists in $area, $city</h1>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Area</th><th>City</th><th>Experience</th><th>Consultancy Fee</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['area'] . "</td>";
        echo "<td>" . $row['city'] . "</td>";
       echo "<td>" . $row['Expereince'] . "</td>";
       echo "<td>" . $row['Fee'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</body></html>";
} else {
    echo "No therapists found in $area, $city";
}

$conn->close();
?>
</div>
  </div>
</body>
</html>
