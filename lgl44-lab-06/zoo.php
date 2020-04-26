<?php
include("includes/init.php");

$animals = [
  "monkey",
  "triceratops",
  "hippopotamus",
  "lobster"
];

// Was the form submitted?
if (isset($_GET['s'])) {
  // Assume the order is valid
  $show_results = FALSE;

  $animal = filter_input(INPUT_GET, 'animal', FILTER_SANITIZE_STRING);
  $animal = strtolower( trim( $animal ) );
  if ( $animal != '' ) {
    $show_results = TRUE;

    // Search for animals
    foreach($animals as $a) {
      if ($animal == $a) {
        $found_animal = $a;
        break;
      }
    }
  }
} else {
  // Form was not submitted.
  $show_results = FALSE;
}
?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <h2>The Cornell Zoo</h2>

    <?php if ( $show_results == FALSE ) { ?>

      <p>We've got animals! Don't believe us? Search for yourself!</p>

      <div class="zoo_gallery">
        <img src="images/monkey.svg" alt="monkey"/>
        <img src="images/triceratops.svg" alt="triceratops"/>
        <img src="images/hippopotamus.svg" alt="hippopotamus"/>
        <img src="images/lobster.svg" alt="lobster"/>
      </div>

      <p>Check to see if the animal you want to see is in our zoo!</p>

    <?php } elseif ( isset($found_animal) ) { ?>

      <p>We've got all the <strong><?php echo htmlspecialchars( $found_animal ); ?></strong> you need!</p>
      <div class="zoo_gallery">
        <img src="images/<?php echo $found_animal; ?>.svg" alt="<?php echo $found_animal; ?>"/>
      </div>

    <?php } else { ?>

      <p>You searched for: <strong><?php echo htmlspecialchars( $animal ); ?></strong>.</p>
      <p>We didn't find that animal and we have all the animals (even the extinct ones). Perhaps you misspelled it. Try correcting your spelling and try again!</p>

    <?php } ?>

    <form id="animalForm" action="zoo.php" method="get">
      <label for="animal_field">Animal:</label>
      <input type="text" id="animal_field" name="animal" value="<?php if ( isset($animal) ) { echo htmlspecialchars($animal); } ?>"/>

      <button name="s" type="submit">Check</button>
    </form>

  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
