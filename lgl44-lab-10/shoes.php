<?php
include("includes/init.php");

// An array to deliver messages to the user.
$messages = array();

function print_record($record) {
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["reviewer"]);?></td>
    <td>
      <?php
      $stars = intval( $record["rating"] );
      for ($i = 1; $i <= 5; $i++) {
        if ($i <= $stars) {
          echo "★";
        } else {
          echo "☆";
        }
      }
      ?>
    </td>
    <td><?php echo htmlspecialchars($record["product_name"]);?></td>
    <td><?php echo htmlspecialchars($record["comment"]);?></td>
  </tr>
  <?php
}

// Search Form

const SEARCH_FIELDS = [
  "reviewer" => "By Reviewer",
  "rating" => "By Rating",
  "product_name" => "By Product",
  "comment" => "By Comment"
];

if ( isset($_GET['search']) && isset($_GET['category']) ) {
  $do_search = TRUE;

  $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);

  // check if the category exists in the SEARCH_FIELDS array
  if (in_array($category, array_keys(SEARCH_FIELDS))) {
    $search_field = $category;
  } else {
    array_push($messages, "Invalid category for search.");
    $do_search = FALSE;
  }

  // Get the search terms
  $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
  $search = trim($search);
} else {
  // No search provided, so set the product to query to NULL
  $do_search = FALSE;
  $category = NULL;
  $search = NULL;
}

// Insert Form

// Get the list of shoes from the database.
$shoes = exec_sql_query($db, "SELECT DISTINCT product_name FROM reviews", NULL)->fetchAll(PDO::FETCH_COLUMN);

if ( isset($_POST["submit_insert"]) ) {
  $valid_review = TRUE;

  $product_name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
  $reviewer = filter_input(INPUT_POST, 'reviewer', FILTER_VALIDATE_EMAIL);
  $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
  $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

  // rating required
  if ( $rating < 1 or $rating > 5 ) {
    $valid_review = FALSE;
  }

  // product name required
  if ( !in_array($product_name, $shoes) ) {
    $valid_review = FALSE;
  }

  // reviewer and comment are optional

  if ($valid_review) {
    $sql = "INSERT INTO reviews (reviewer, rating, product_name, comment) VALUES (:reviewer, :rating, :product_name, :comment)";
    $params = array(
      ':reviewer' => $reviewer,
      ':rating' => $rating,
      ':product_name' => $product_name,
      ':comment' => $comment
    );

    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      array_push($messages, "Your review has been recorded. Thank you!");
    } else {
      array_push($messages, "Failed to add review.");
    }
  } else {
    array_push($messages, "Failed to add review. Invalid product or rating.");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <h1>2300 Shoe Review</h1>

    <p>Welcome to the 2300 Shoe Review!</p>

    <?php
    // Write out any messages to the user.
    foreach ($messages as $message) {
      echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
    }
    ?>

    <form id="searchForm" action="shoes.php" method="get">
      <select name="category">
        <option value="" selected disabled>Search By</option>
        <?php
        foreach(SEARCH_FIELDS as $field_name => $label){
          ?>
          <option value="<?php echo $field_name;?>"><?php echo $label;?></option>
          <?php
        }
        ?>
      </select>
      <input type="text" name="search"/>
      <button type="submit">Search</button>
    </form>

    <?php
    if ($do_search) {
      // We have a specific shoe to query!
      ?>
      <h2>Search Results</h2>
      <?php

      // Be careful to filter $search_field above. If you're not careful, you can seriously break your database.
      $sql = "SELECT * FROM reviews WHERE " . $search_field . " LIKE '%' || :search || '%'";
      $params = array(
        ':search' => $search
      );
    } else {
      // No shoe to query, so return everything!
      ?>
      <h2>All Reviews</h2>
      <?php

      $sql = "SELECT * FROM reviews";
      $params = array();
    }

    // Get the shoes to display
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      // The query was successful, let's get the records.
      $records = $result->fetchAll();

      if ( count($records) > 0 ) {
        // We have records to display
        ?>
        <table>
          <tr>
            <th>Reviewer</th>
            <th>Rating</th>
            <th>Product</th>
            <th>Comments</th>
          </tr>

          <?php
          foreach($records as $record) {
            print_record($record);
          }
          ?>
        </table>
        <?php
      } else {
        // No results found
        echo "<p>No matching reviews found.</p>";
      }
    }
    ?>

    <h2>Review a Shoe</h2>
    <p>Add your own review:</p>

    <form id="reviewShoe" action="shoes.php" method="post">
      <ul>
        <li>
          <label>Email:</label>
          <input type="email" name="reviewer"/>
        </li>
        <li>
          <label>Rating:</label>
          <input type="radio" name="rating" value="5" checked/>5
          <input type="radio" name="rating" value="4"/>4
          <input type="radio" name="rating" value="3"/>3
          <input type="radio" name="rating" value="2"/>2
          <input type="radio" name="rating" value="1"/>1
        </li>
        <li>
          <label>Product Name:</label>
          <select name="product_name">
            <option value="" selected disabled>Choose Shoe</option>
            <?php
            foreach($shoes as $shoe) {
              echo "<option value=\"" . htmlspecialchars($shoe) . "\">" . htmlspecialchars($shoe) . "</option>";
            }
            ?>
          </select>
        </li>
        <li>
          <label>Comment:</label>
        </li>
        <li>
          <textarea name="comment" cols="40" rows="5"></textarea>
        </li>
        <li>
          <button name="submit_insert" type="submit">Add Review</button>
        </li>
      </ul>
    </form>

  </div>

  <?php include("includes/footer.php"); ?>
</body>

</html>
