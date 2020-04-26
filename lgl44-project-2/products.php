<?php
// DO NOT REMOVE!
$title="Our Products";
include("includes/init.php");

$db = open_sqlite_db("secure/data.sqlite");
// An array to deliver messages to the user.
$messages = array();
function print_store($store) {
  ?>
  <tr>
    <td><?php echo htmlspecialchars($store["product_name"]);?></td>
    <td>
      <?php echo htmlspecialchars($store["price"]);?>
    </td>
    <td><?php echo htmlspecialchars($store["estimated_shipping"]);?></td>
    <td><?php echo htmlspecialchars($store["in_stock"]);?></td>
  </tr>
  <?php
}

// Search Form
const SEARCH_FIELDS = [
  "product_name" => "Name",
  "price" => "Price",
  "estimated_shipping" => "Estimated Shipping Days",
  "in_stock" => "Quantity in Stock"
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
$products = exec_sql_query($db, "SELECT DISTINCT product_name FROM products", NULL)->fetchAll(PDO::FETCH_COLUMN);
if ( isset($_POST["submit_insert"]) ) {
  $valid_product = TRUE;
  $product_name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
  $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
  $estimated_shipping = filter_input(INPUT_POST, 'estimated_shipping', FILTER_VALIDATE_INT);
  $in_stock = filter_input(INPUT_POST, 'in_stock', FILTER_VALIDATE_INT);
  // price cannot be negative
  if ( $price < 0 ) {
    $valid_product = FALSE;
    echo '<script>console.log("price error")</script>';
  }
  if ( $in_stock < 0 ) {
    $valid_product = FALSE;
    echo '<script>console.log("price error")</script>';
  }

  if ( empty($product_name) ) {
    $valid_product = FALSE;
    echo '<script>console.log("price error")</script>';
  }

  if ($valid_product) {
    $sql = "INSERT INTO products (product_name, price, estimated_shipping, in_stock) VALUES (:product_name, :price, :estimated_shipping, :in_stock)";
    $params = array(
      ':product_name' => $product_name,
      ':price' => $price,
      ':estimated_shipping' => $estimated_shipping,
      ':in_stock' => $in_stock
    );
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      array_push($messages, "Your product has been added to our list and will be in stock soon. Thank you!");
    } else {
      array_push($messages, "Failed to add product.");
    }
  } else {
    array_push($messages, "Failed to add product. Please recheck and make sure you inputted the price or name correctly.");
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Cayuga Heights Sporting Goods</title>
  <link rel="stylesheet" type="text/css" href="styles/css.css" media="all" />
</head>

<body>
<?php include("includes/header.php"); ?>
<h1>Cayuga Heights Sporting Goods online store</h1>

    <p id="producttext">Welcome to the online store, below is the list of products we have available. Use the search bar to view products according to your
      specifcations.
    </p>

<div id="content-wrap">



    <form id="searchForm" action="products.php" method="get">
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
      // search for products
      ?>
      <h2>Search Results</h2>
      <?php

      $sql = "SELECT * FROM products WHERE " . $search_field . " LIKE '%' || :search || '%'";
      $params = array(
        ':search' => $search
      );
    } else {

      ?>
      <h2>All Products</h2>
      <?php
      $sql = "SELECT * FROM products";
      $params = array();
    }

    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      // The query was successful, let's get the records.
      $all_products = $result->fetchAll();
      if ( count($all_products) > 0 ) {
        // We have records to display
        ?>
        <table>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Estimated Shipping</th>
            <th>Quantity In Stock</th>
          </tr>

          <?php
          foreach($all_products as $product) {
            print_store($product);
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


  <h2>Is there a product you want that isn't listed here?</h2>
    <p>Feel free to enter the product you want and we will aim to have it available by next week!:</p>

    <div id="message">
    <?php
    // Write out any messages to the user.
    foreach ($messages as $message) {
      echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
    }
    ?>
    </div>

    <form id="reviewShoe" action="products.php" method="post">
      <ul>
        <li>
          <label>Name:</label>
          <input type="text" name="product_name"/>
        </li>
        <li>
          <label>Desired Price:</label>
          <input type="number" name="price" step="any" min="1"/>

        </li>
        <li>
          <label>Desired Shipping time (in days):</label>
          <input type="number" name="estimated_shipping" min="1"/>
        </li>

        <li>
          <label>Desired Quantity :</label>
          <input type="number" name="in_stock"  min="1"/>
        </li>
        <li>
          <button name="submit_insert" type="submit">Add Product</button>
        </li>
      </ul>
    </form>





<?php include("includes/footer.php"); ?>
</body>
</html>
