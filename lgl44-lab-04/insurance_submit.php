<?php
include("includes/init.php");

// enrollment form data
if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  $email = filter_input(INPUT_POST, "dependents", FILTER_VALIDATE_EMAIL);
  $dob = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING);
  $phone_number = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING);
  $dependents = filter_input(INPUT_POST, "dependents", FILTER_VALIDATE_INT);
  $coverage = $_POST["coverage"];
  $deductible = filter_input(INPUT_POST, "dependents", FILTER_VALIDATE_INT);
  if ($dependents < 0) {
    $dependents = NULL;
  }


  htmlspecialchars($name);
  htmlspecialchars($email);
  htmlspecialchars($dob);
  htmlspecialchars($phone_number);
  htmlspecialchars($dependents);
  htmlspecialchars($coverage);
  htmlspecialchars($deductible);
}




?>
<!DOCTYPE html>
<html>

<?php include("includes/head.php"); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">Insurance Application Submission</h1>

      <h2>Application for <?php echo($name); ?></h2>

      <p>
        <?php
        echo("<h4>Email Address: " . $email . "</h4>");
        echo("<h4>Date of Birth: " . $dob . "</h4>");
        echo("<h4>Phone Number: " . $phone_number . "</h4>");
        echo("<h4>Number of Dependents: " . $dependents . "</h4>");
        echo("<h4>Coverage Plan: " . $coverage . "</h4>");
        echo("<h4>Current Deductible: " . $deductible . "</h4>");
        ?>
      </p>

    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
