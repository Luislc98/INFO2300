<?php
include("includes/init.php");

// enrollment form data
if (isset($_POST["submit"])) {
  $client_first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING);
  $client_last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING);
  $client_email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

  // If you don't know how to use regular expressions, just use the FILTER_SANITIZE_STRING
  if (filter_input(INPUT_POST, "dob", FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(\d{4})-(\d{2})-(\d{2})$/")))) {
    $client_dob = $_POST["dob"];
  } else {
    $client_dob = NULL;
  }

  // You might want to use a regular expression to validate the phone number
  $client_phone_number = filter_input(INPUT_POST, "phone_number", FILTER_SANITIZE_STRING);

  $client_dependents = filter_input(INPUT_POST, "dependents", FILTER_VALIDATE_INT);
  if ($client_dependents < 0) {
    $client_dependents = NULL;
  }

  // Check if client coverage is a correct value
  $client_coverage = filter_input(INPUT_POST, "coverage", FILTER_SANITIZE_STRING);
  $client_coverage = strtolower($client_coverage);
  if ( !in_array($client_coverage, array("basic", "premium", "full")) ) {
    $client_coverage = NULL;
  }

  $client_deductible = filter_input(INPUT_POST, "deductible", FILTER_VALIDATE_FLOAT);
  if ($client_deductible < 0.0 or $client_deductible > 100.0) {
    $client_deductible = NULL;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php"); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">Insurance Application Submission</h1>

      <h2>Application for <?php echo(htmlspecialchars($client_last_name) . ", " . htmlspecialchars($client_first_name)); ?></h2>

      <p>
        <?php
        echo("<h4>Email Address: " . htmlspecialchars($client_email) . "</h4>");
        echo("<h4>Date of Birth: " . htmlspecialchars($client_dob) . "</h4>");
        echo("<h4>Phone Number: " . htmlspecialchars($client_phone_number) . "</h4>");
        echo("<h4>Number of Dependents: " . $client_dependents . "</h4>");
        echo("<h4>Coverage Plan: " . $client_coverage . "</h4>");
        echo("<h4>Current Deductible: " . $client_deductible . "</h4>");
        ?>
      </p>

    </article>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
