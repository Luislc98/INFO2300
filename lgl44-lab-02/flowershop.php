<?php
include("includes/init.php");

$title = 'Flower Shop';

// Was the form submitted?
if (isset($_POST['submit'])) {
  // TODO: Assume the order is valid
  echo("form submitted");
  $order_name= 'order_name';
  $valid_order = TRUE;
  if ($order_name == ''){
    $valid_order = FALSE;
  }
  // Name is required.
  // TODO: Check if name is not the empty string ('')

  // Convert stems to integers so we can do math
  $roses = filter_input(INPUT_POST, 'roses', FILTER_VALIDATE_INT);
  $daisies = filter_input(INPUT_POST, 'daisies', FILTER_VALIDATE_INT);
  $gardenias = filter_input(INPUT_POST, 'gardenias', FILTER_VALIDATE_INT);
  // the sum of all the flowers to check if a min of 3 are ordered
  $num= $roses + $daisies + $gardenias;
  if ($num < 3) {
  $valid_order = FALSE;
  }
  // Check that a minimum of 3 stems was ordered.
  // TODO: Check the minimum number of stems.
} else {
  // Form was not submitted.
  echo("form not  submitted");
  // Set default number of stems of an order.
  $roses = 0;
  $daisies = 0;
  $gardenias = 0;
}
?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">

      <h1 id="article-title">2300 Flower Shop</h1>
      <p>Welcome to the 2300 Flower Shop!</p>

      <?php
      if ( isset($valid_order) && $valid_order ) { ?>

        <!-- TODO: order confirmation page. -->

      <?php } else { ?>

        <h2>Order Form</h2>
        <p>Each stem is $3. Minimum order is 3 stems.</p>

        <form id="flower_order" method="post" action="flowershop.php">
          <fieldset>
            <legend>Flower Stem Order Form</legend>

            <p class="form_error hidden">Please provide a name for your order.</p>
            <p>
              <label for="name_field">Name on Order:</label>
              <input id="name_field" type="text" name="order_name" <?php echo $order_name; ?>/>
            </p>

            <ul>
              <li class="order">
                <label for="roses_input">Roses:</label>
                <input type="number" id="roses_input" name="roses" min="0" value="<?php echo $roses; ?>"/>
              </li>
              <li class="order">
                <label for="daisies_input">Daisies:</label>
                <input type="number" id="daisies_input" name="daisies" min="0" value="<?php echo $daisies; ?>"/>
              </li>
              <li class="order">
                <label for="gardenias_input">Gardenias:</label>
                <input type="number" id="gardenias_input" name="gardenias" min="0" value="<?php echo $gardenias; ?>"/>
              </li>
            </ul>
            <p class="formnum_error hidden">Less than three flowers were ordered. Please choose at least 3 flowers to order</p>
            <input type="submit" name="submit" value="submit"/>
          </fieldset>
        </form>

      <?php } ?>

    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
