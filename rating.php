<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GeekyHome</title>
  <link id="pagestyle" rel="stylesheet" href="light.css">
  <script type="application/javascript" src="script.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="book-body">
  <nav class="navbar">
    <label class="logo">GeekyHome</label>
    <ul class="menu">
      <li><a href="homepage.html">Home</a></li>
      <li><a href="books.html">All Books</a></li>
      <li><a href="rating.php">Books Rating</a></li>
      <li><a href="about.html">About</a></li>
    </ul>
  </nav>
  <section class="rating">
    <section class="table-header">
      <h1>All Book Ratings</h1>
    </section>
    <form class="ratings-form" method="GET">
      <div class="select-form">
        <div class="select-box">
          <span>Select to filter by Book:</span>
          <select id="book" name="book">
            <option selected disabled>Choose a Book</option>
            <?php
            // Connect to your MySQL database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bookreview";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve the list of books from the database
            $sql = "SELECT bookId, title FROM Book";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["bookId"] . "'>" . $row["title"] . "</option>";
                }
            }
            $conn->close();
            ?>
          </select>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn">
      </div>
    </form>
    <?php
      // Check if form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['submit'])) {
        $selectedBookId = $_GET['book'];

        // Connect to your MySQL database
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
      }

      // Fetch all book reviews
      // Connect to database
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
      }

      // Construct the base SQL query
      $sql = "SELECT Book.title, Reviewer.reviewerName, Report.rating, Report.reviewDate
              FROM Book
              INNER JOIN Report ON Book.bookId = Report.bookId
              INNER JOIN Reviewer ON Report.reviewerId = Reviewer.reviewerId";

      // Check if a book is selected to apply filtering
      if (isset($selectedBookId)) {
        $sql .= " WHERE Book.bookId = '$selectedBookId'";
      }


      // Execute the SQL query
      $result = $conn->query($sql);

      // Display data in a table
      if ($result->num_rows > 0) {
        echo "<table class='tb'>
                <tr>
                  <th>Title</th>
                  <th>Reviewer</th>
                  <th>Rating</th>
                  <th>Review Date</th>
                </tr>";
      // Output data of each row
      while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".$row["title"]."</td>
                  <td>".$row["reviewerName"]."</td>
                  <td class='num'>".$row["rating"]."</td>
                  <td>". date("jS F Y", strtotime($row['reviewDate'])) ."</td>
                  </tr>";
                  }
                  echo "</table>";
      } else {
                  echo "0 results";
      }
      $conn->close();
      ?>

      <a href="ratebook.html">
        <input type="submit" name="submit" value="Leave a Rating!" class="btn2">
      </a>
    </section>
</body>
</html>
