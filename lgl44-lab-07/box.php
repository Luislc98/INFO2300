<?php
include("includes/init.php");
?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <h1>2300 Plop Box</h1>

    <p>Welcome to the 2300 Plop Box, a file storing service!</p>

    <?php
    print_messages();
    ?>

    <h2>Upload a File to 2300 Plop Box</h2>

    <p>We'll learn how to upload files in Lab 8...</p>

    <h2>Saved Files</h2>
    <ul>
      <?php
      $records = exec_sql_query($db, "SELECT * FROM documents")->fetchAll(PDO::FETCH_ASSOC);
      foreach($records as $record){
        echo "<li><a href=\"uploads/documents/" . $record["id"] . "." . $record["file_ext"] . "\">" . htmlspecialchars($record["file_name"]) . "</a> - " . htmlspecialchars($record["description"]) . "</li>";
      }
      ?>
    </ul>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
