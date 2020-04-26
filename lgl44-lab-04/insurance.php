<?php
include("includes/init.php");
?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <article id="content">
      <h1 id="article-title">2300 Insurance Company</h1>
      <p>Welcome to the 2300 Insurance Company!</p>

      <h2>2300 Insurance Plan Application</h2>

      <form id="insurance_form" method="post" action="insurance_submit.php">
        <fieldset>
          <legend>Insurance Application 2018</legend>

          <ul>
            <li class="app_order">
              Name:
              <input type="text" name="name" />
            </li>
            <li class="app_order">
              Address:
              <input type="email" name="email" />
            </li>
            <li class="app_note">Please put in the mm/dd/yyyy format</li>
            <li class="app_order">
              Date of Birth:
              <input type="text" name="dob" />
            </li>
            <li class="app_note">Please put in the (xxx) xxx-xxxx format</li>
            <li class="app_order">
              Phone Number:
              <input type="text" name="phone_number" />
            </li>
            <li class="app_order">
              Number of Dependents:
              <input type="number" name="dependents" />
            </li>
            <li class="app_note">Please choose from Basic, Full, and Premium</li>
            <li class="app_order">
              Coverage Plan:
              <input type="text" name="coverage" >
            </li>
            <li class="app_order">
              Current Deductible Rate:
              <input type="text" name="deductible" />
            </li>
          </ul>

          <input id="app_button" type="submit" name="submit" value="Submit Application"/>
        </fieldset>
      </form>

    </article>
  </div>
  <?php include("includes/footer.php");?>
</body>
<style>body { background-color: red; }</style>

</html>
