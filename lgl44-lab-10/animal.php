<?php
include("includes/init.php");

// Find animal by ID
if (isset($_GET['id'])) {
  $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

  $sql = "SELECT * FROM animals WHERE id = :id;";
  $params = array(
    ':id' => $id
  );
  $result = exec_sql_query($db, $sql, $params);
  if ($result) {
    // The query was successful, let's get the records.
    $animals = $result->fetchAll();
    if ( count($animals) > 0 ) {
      $animal = $animals[0];
    }
  }
}

// Find animal by name
if (isset($_GET['animal'])) {
  $name = filter_input(INPUT_GET, 'animal', FILTER_SANITIZE_STRING);
  $name = strtolower($name);

  $sql = "SELECT * FROM animals WHERE LOWER(name) = :name;";
  $params = array(
    ':name' => $name
  );
  $result = exec_sql_query($db, $sql, $params);
  if ($result) {
    // The query was successful, let's get the records.
    $animals = $result->fetchAll();
    if ( count($animals) > 0 ) {
      $animal = $animals[0];
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <?php if ( isset($animal) ) { ?>

      <h2><?php echo htmlspecialchars($animal['name']) ?></h2>

      <p>The 2300 Zoo has <?php echo $animal['count']; ?> <?php echo strtolower($animal['name']); ?>(s).</p>

      <figure class="large_animal">
        <img src="images/animals/<?php echo $animal['id']; ?>.svg" alt="<?php echo htmlspecialchars($animal['name']); ?>"/>
      </figure>

      <blockquote>
        <p><?php echo htmlspecialchars($animal['description']); ?></p>
        Source: <cite><a href="<?php echo $animal['source']; ?>"><?php echo $animal['source']; ?></a></cite>
      </blockquote>

    <?php } else { ?>

      <p>Sorry, we couldn't find that animal. Please try your <a href="zoo.php">search</a> again.</p>

    <?php } ?>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
