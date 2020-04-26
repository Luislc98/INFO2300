<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" media="all" />
  <title>Home</title>
</head>

<body>

  <?php
  $title = "Ithaca Natural Appreciation Society";
  include("includes/header.php");

 ?>

  <p class="indextext"> Welcome to the Ithaca Nature appreciation Society! Founded in 1987, we are a group of seasoned travel enthusiasts that love visiting picturesque sites
  all around the world. We have ample experience with sites all over the globe, from the Great Coral Reef of Australia to Niagara Falls in Canada. Our mission is to spread the love of nature and help people find it all over the world.
  </p>
  <div id="mainpic">
      <img id="nature" src="images/nature.jpg" alt="Nature Appreciation Society ">
      <br>
      Source: <cite><a href="http://www.appreciationsociety.com/?quote=appreciation-society-quote-of-the-day-september-19">appreciation society</a></cite>
  </div>
  <!-- Source: http://www.appreciationsociety.com/?quote=appreciation-society-quote-of-the-day-september-19 -->
  <p  class="indextext">
  Given our expertise with knowing the best places to visit, the Ithaca Nature appreciation society has compiled a list of the sites we believe are definitely worth traveling to. We also included some brief but helpful infomration about each location  that will help you decide
  the best places for you to visit!
  </p>
  <!-- TODO: This should be your main page for your site. -->

<?php include("includes/footer.php"); ?>

</body>
</html>
