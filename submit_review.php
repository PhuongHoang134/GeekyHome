<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookreview";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$reviewer = $_POST['reviewer'];
$book = $_POST['book'];
$rating = $_POST['rating'];

// Insert into Report table
$sql = "INSERT INTO Report (bookId, reviewerId, rating, reviewDate)
        VALUES ('$book', '$reviewer', $rating, NOW())";

if ($conn->query($sql) === TRUE) {
  echo '<script>alert("Review submitted successfully!"); window.location.replace("rating.php");</script>';
} else {
  echo '<script>alert("The reviewer already rated this book!"); window.location.replace("rating.php");</script>';
}

$conn->close();
?>
