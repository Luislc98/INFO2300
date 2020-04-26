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
  $title = "Our Travel List";
  include("includes/header.php");
// Get a list of all the travel locations from the database
  $locations = exec_sql_query($db, "SELECT * FROM images;")->fetchAll();
  $taglist = exec_sql_query($db, "SELECT * FROM tags;")->fetchAll();
  // this function gives all the images with the name and description
  function show_all_recommendations($locations) {
    echo '<div class="gallerypic">';
    echo '<a href="recommendations.php?' . http_build_query( array( 'id' => $locations['id'] ) ) . '"><img id="gallery" src="uploads/images/' . $locations['id'] . '.jpg" alt="' . htmlspecialchars($locations['id']) . '"/></a>' . PHP_EOL;
    echo '<p class="locationtitle" >'. 'Location Name:   ' .htmlspecialchars($locations['location_name']).  '<p>';
    echo '<p>'. 'Description:   '  .htmlspecialchars($locations['description']).  '<p>';
    echo'</div>';
  }
  // this function gives a single image and all the tags associated with it
  function show_recommendations($locations) {
    echo '<div class="gallerypic">';
    echo '<a href="recommendations.php?' . http_build_query( array( 'id' => $locations['id'] ) ) . '"><img id="singlegallery" src="uploads/images/' . $locations['id'] . '.jpg" alt="' . htmlspecialchars($locations['id']) . '"/></a>' . PHP_EOL;
    echo '<p class="locationtitle" >'. 'Location Name:   ' .htmlspecialchars($locations['location_name']).  '<p>';
    echo '<p>'. 'Description:   '  .htmlspecialchars($locations['description']).  '<p>';
    echo'</div>';

  }
  function show_tags($tags) {

    echo '<p>'.htmlspecialchars($tags['tag']).  '<p>';

  }

function show_tag_list($taglist) {
  echo '<p>'.htmlspecialchars($taglist['tag']).  '<p>';

}



// Was location form submitted?
if (isset($_GET['location'])) {
  $show_results = FALSE;
  $location = filter_input(INPUT_GET, 'location', FILTER_SANITIZE_STRING);

  //makes the variable lowercase so it fits parameter of databases
  $location = strtolower( trim( $location ) );
  if ( $location != '' ) {
    $show_results = TRUE;
    $sql = "SELECT * FROM images WHERE location_name LIKE '%' || :search || '%'";
    $sql2 = "SELECT tags.tag FROM tags LEFT OUTER JOIN image_tags ON image_tags.tag_id=tags.id WHERE
    (SELECT id FROM images WHERE location_name=:search )=image_tags.image_id";
    $params = array(
      ':search' => $location
    );
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      // The query was successful, let's get the records.
      $found_locations = $result->fetchAll();
    }
    $result2 = exec_sql_query($db, $sql2, $params);
    if ($result2) {
      // The query was successful, let's get the records.
      $found_location_tags = $result2->fetchAll();
    }
  }
} else {
  // Form was not submitted.
  $show_results = FALSE;
}

// was tag form submitted
if (isset($_GET['tag'])) {
  $show_tag_results = FALSE;
  $tag = filter_input(INPUT_GET, 'tag', FILTER_SANITIZE_STRING);

  //makes the variable lowercase so it fits parameter of databases
  $tag = strtolower( trim( $tag ) );
  if ( $tag != '' ) {
    $show_tag_results = TRUE;
   // $sql = "SELECT * FROM images WHERE location_name LIKE '%' || :search || '%'";



    $sql_tag = "SELECT images.id,images.location_name, images.file_name, images.file_ext, images.description FROM images LEFT OUTER JOIN image_tags ON image_tags.image_id=images.id LEFT OUTER JOIN tags ON image_tags.tag_id=tags.id WHERE tags.tag = :searchtag ";
    echo '<script>console.log("Your stuff here")</script>';

    $tag_params2 = array(
      ':searchtag' => $tag
    );



    $result_tag = exec_sql_query($db, $sql_tag, $tag_params2);
    if ($result_tag) {
      // The query was successful, let's get the records.
      $found_tags = $result_tag->fetchAll();
      echo '<script>console.log("Your stuff here works")</script>';
    }
  }
} else {
  // Form was not submitted.
  $show_tag_results = FALSE;
}

 ?>
<p> Welcome to our society's nature travel recommendations!
</p>

<?php if ( $show_results == FALSE ) { ?>

<p>If you already have a travel location in mind, please input the name and we'll give you our advice!</p>
<!-- Image Gallery Citations -->
<!--Amazon  Source: https://actu.epfl.ch/news/tall-trees-are-crucial-for-the-survival-of-the-ama/ -->
<!-- Grand Canyon Source: https://www.outsideonline.com/2367261/grand-canyon-travel-guide -->
<!-- Barrier Reef Source:  https://www.barrierreef.org/-->
<!-- Mount Everest Source: https://abcnews.go.com/International/china-closes-mount-everest-base-camp-tourists-garbage/story?id=61144089-->
<!--Niagara Falls Source: https://twotravelingtexans.com/practical-tips-for-visiting-niagara-falls/ -->
<!--Paracutin  Source: https://www.worldatlas.com/articles/paricutin-volcano-mexico.html-->
<!-- Redwoods Source: https://hub.jhu.edu/2017/09/27/redwood-genome-sequencing-project/ -->
<!--Stonehenge  Source: https://www.english-heritage.org.uk/visit/places/stonehenge/history-and-stories/history/-->
<!--Victoria Falls Source: https://victoriafallstourism.org/-->
<!--Yosemite Falls Source: https://www.tripsavvy.com/yosemite-waterfalls-overview-4126556 -->

<form id="locationForm" action="recommendations.php" method="get">
  <label for="location_field">Location:</label>
  <input type="text" id="location_field" name="location" value="<?php if ( isset($location) ) { echo htmlspecialchars($location); } ?>"/>

  <button type="submit">Search</button>
</form>



<div class="image_gallery">
        <?php
        foreach($locations as $l) {
          show_all_recommendations($l);
        }

        ?>
      </div>

      <?php } elseif ( isset($found_locations) ) { ?>

<p>You searched for: <strong><?php echo htmlspecialchars( $location ); ?></strong></p>
<p>This is what we found. If nothing is shown please try again and make sure your spelling is correct:</p>

<div class="image_gallery">
  <?php
  foreach($found_locations as $l) {
    show_recommendations($l);
  }
  echo '<p>'. 'Tags: '. '<p>';
  foreach($found_location_tags as $l) {
    show_tags($l);
  }
  found_location_tags

  ?>
</div>

<?php } else { ?>

<p>You searched for: <strong><?php echo htmlspecialchars( $location ); ?></strong></p>
<p>We didn't find that location. Try correcting your spelling and try again!</p>

<?php } ?>


<?php if ( $show_tag_results == FALSE ) { ?>

<p>You can also instead start your search by writing in something you are looking for in a trip </p>
<p> Below are the current distinctions we have on our list for our locations. Write in one of these to find the
  best location for you! <p>

  <div class="tag_list">
        <?php
        foreach($taglist as $t) {
          show_tag_list($t);
        }

        ?>
      </div>

<form id="tagForm" action="recommendations.php" method="get">
  <label for="tag_field">Tag Search:</label>
  <input type="text" id="tag_field" name="tag" value="<?php if ( isset($tag) ) { echo htmlspecialchars($tag); } ?>"/>

  <button type="submit">Search</button>
</form>




<?php } elseif ( isset($found_tags) ) { ?>

<p>You searched for: <strong><?php echo htmlspecialchars( $tag ); ?></strong></p>
<p>We've found these Locations based on the tags you inputted in our list:</p>

<div class="image_gallery">
  <?php
  foreach($found_tags as $t) {
    show_recommendations($t);
  }
  //echo '<p>'. 'Tags: '. '<p>';
  //foreach($found_location_tags as $l) {
  //  show_tags($l);
 // }


  ?>

<?php } else { ?>

<p>You searched for: <strong><?php echo htmlspecialchars( $tag ); ?></strong></p>
<p>We didn't any location based on that tag. Try correcting your spelling and try again!</p>

<?php } ?>

<?php

if ( isset($_POST["submit_tag"])  ) {
  echo '<script>console.log("first if passes")</script>';
  $show_add_tag_results = FALSE;
  $add_tag_to_image = filter_input(INPUT_POST, 'add_tag_to_image', FILTER_SANITIZE_STRING);
  $add_tag = filter_input(INPUT_POST, 'add_tag', FILTER_SANITIZE_STRING);

  //makes the variable lowercase so it fits parameter of databases
  $add_tag_to_image = strtolower( trim( $add_tag_to_image ) );
  $add_tag = strtolower( trim( $add_tag ) );
  if ( $add_tag != '' && $add_tag_to_image != '' ) {
    echo '<script>console.log("Your stuff here")</script>';
    $show_add_tag_results = TRUE;
    // gets the image record of location
    $tag_to_location = exec_sql_query(
      $db,
      "SELECT * FROM images WHERE location_name = :location_add;",
      array(':location_add' => $add_tag_to_image)
      )->fetchAll();
    // search tag table to see if inputted string is already a tag
    $is_tag_existent = exec_sql_query(
      $db,
      "SELECT * FROM tags WHERE tag = :created_tag;",
      array(':created_tag' => $add_tag)
      )->fetchAll();
  // check to see if the desired tag the user inputted is already a tag and if location is valid
    if (count($is_tag_existent) > 0 and count($tag_to_location) > 0 ) {
      $sql_existing_tag = "INSERT INTO image_tags (  image_id,tag_id ) VALUES (  :new_image_id,:new_tag_id)";
      $params_existing_tag = array(

        ':new_image_id' => $tag_to_location[0]['id'],
        ':new_tag_id' => $is_tag_existent[0]['id'],
      );
      $result_used_existing_tag = exec_sql_query($db, $sql_existing_tag, $params_existing_tag);
    }
    // if tag does not already exist, we must insert it into the tags table
    else {
      echo '<script>console.log("else loop ")</script>';
      $sql_add_new_tag = "INSERT INTO tags (tag) VALUES (:new_tag)";
      $params_new_tag = array(
        ':new_tag' => $add_tag,
      );
      //adds new tag to tags table
      $result_add_new_tag = exec_sql_query($db, $sql_add_new_tag, $params_new_tag);
      //adds tag and image relationship on image_tags table
      $sql_new_tag = "INSERT INTO image_tags (  image_id,tag_id ) VALUES (  :new_image_id,:new_tag_id)";
      //now that the tag is inserted search for it again
      $is_tag_existent_now = exec_sql_query(
        $db,
        "SELECT * FROM tags WHERE tag = :created_tag;",
        array(':created_tag' => $add_tag)
        )->fetchAll();
      $params_new_tag = array(
        ':new_image_id' => $tag_to_location[0]['id'],
        ':new_tag_id' => $is_tag_existent_now[0]['id'],
      );
      $result_used_new_tag = exec_sql_query($db, $sql_new_tag, $params_new_tag);
    }


  }

}


else {
  // Form was not submitted.
  echo '<script>console.log("form not working ")</script>';
  $show_results = FALSE;
}



?>

<p> Think that maybe after your trip or doing some serious research that our list could do with more flavor? Feel free
  to use the form below to add a tag to a location. You can add an already exisiting paramter displayed above or add in your own.
<p>
<form id="addtagForm" action="recommendations.php" method="post">
  <label for="add_tag_field">Tag:</label>
  <input type="text" id="add_tag_field" name="add_tag" value="<?php if ( isset($add_tag) ) { echo htmlspecialchars($add_tag); } ?>"/>
  <label for="locationname">Location Name:</label>
  <input type="text" id="locationname" name="add_tag_to_image" value="<?php if ( isset($add_tag_to_image) ) { echo htmlspecialchars($add_tag_to_image); } ?>"/>

  <button name="submit_tag" type="submit">Add tag</button>
</form>



<?php include("includes/footer.php"); ?>
</body>
</html>
