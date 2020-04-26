<?php
include("includes/init.php");

// Get a list of animals from the database
$animals = exec_sql_query($db, "SELECT * FROM animals;")->fetchAll();

// Was the form submitted?
if (isset($_GET['animal'])) {
  $show_results = FALSE;

  $animal = filter_input(INPUT_GET, 'animal', FILTER_SANITIZE_STRING);
  $animal = strtolower( trim( $animal ) );
  if ( $animal != '' ) {
    $show_results = TRUE;

    $sql = "SELECT * FROM animals WHERE name LIKE '%' || :search || '%'";
    $params = array(
      ':search' => $animal
    );
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      // The query was successful, let's get the records.
      $found_animals = $result->fetchAll();
    }
  }
} else {
  // Form was not submitted.
  $show_results = FALSE;
}

function print_animal_thumb($animal) {
  echo '<a href="animal.php?' . http_build_query( array( 'id' => $animal['id'] ) ) . '"><img src="images/animals/' . $animal['id'] . '.svg" alt="' . htmlspecialchars($animal['name']) . '"/></a>' . PHP_EOL;
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <h2>The Cornell Zoo</h2>

    <?php if ( $show_results == FALSE ) { ?>

      <p>We've got animals! Don't believe us? Search for yourself!</p>

      <form id="animalForm" action="zoo.php" method="get">
        <label for="animal_field">Animal:</label>
        <input type="text" id="animal_field" name="animal" value="<?php if ( isset($animal) ) { echo htmlspecialchars($animal); } ?>"/>

        <button type="submit">Check</button>
      </form>

      <div class="zoo_gallery">
        <?php
        foreach($animals as $a) {
          print_animal_thumb($a);
        }
        ?>
      </div>

    <?php } elseif ( isset($found_animals) ) { ?>

      <p>You searched for: <strong><?php echo htmlspecialchars( $animal ); ?></strong></p>
      <p>We've found these animals at the 2300 Zoo:</p>
      <div class="zoo_gallery">
        <?php
        foreach($found_animals as $a) {
          print_animal_thumb($a);
        }
        ?>
      </div>

    <?php } else { ?>

      <p>You searched for: <strong><?php echo htmlspecialchars( $animal ); ?></strong></p>
      <p>We didn't find that animal and we have all the animals (even the extinct ones). Perhaps you misspelled it. Try correcting your spelling and try again!</p>

    <?php } ?>

  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
