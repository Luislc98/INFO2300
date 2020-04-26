<?php

// check current php version to ensure it meets 2300's requirements
function check_php_version()
{
    if (version_compare(phpversion(), '7.0', '<')) {
        define(VERSION_MESSAGE, "PHP version 7.0 or higher is required for 2300. Make sure you have installed PHP 7 on your computer and have set the correct PHP path in VS Code.");
        echo VERSION_MESSAGE;
        throw VERSION_MESSAGE;
    }
}
check_php_version();

function config_php_errors()
{
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
}
config_php_errors();

// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename)
{
    if (!file_exists($db_filename)) {
        $db = new PDO('sqlite:' . $db_filename);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (file_exists($init_sql_filename)) {
            $db_init_sql = file_get_contents($init_sql_filename);
            try {
                $result = $db->exec($db_init_sql);
                if ($result) {
                    return $db;
                }
            } catch (PDOException $exception) {
                // If we had an error, then the DB did not initialize properly,
                // so let's delete it!
                unlink($db_filename);
                throw $exception;
            }
        } else {
            unlink($db_filename);
        }
    } else {
        $db = new PDO('sqlite:' . $db_filename);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    return null;
}

function exec_sql_query($db, $sql, $params = array())
{
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
        return $query;
    }
    return null;
}

// open connection to database
$db = open_or_init_sqlite_db("website.sqlite", "init/init.sql");

// Navigation
$pages = [
  ['index.php', 'Home'],
  ['about.php', 'About'],
  ['standards.php', 'Standards'],
  ['citations.php', 'Citations'],
  ['zoo.php', 'Zoo'],
  ['flowershop.php', 'Flower Shop'],
  ['insurance.php', 'Insurance']
];
$current_file = basename($_SERVER['PHP_SELF']);

function print_title() {
  global $pages, $current_file;
  $title = '';

  // Find the current page
  foreach( $pages as $page ) {
    $file = $page[0];
    $name = $page[1];

    if ($current_file == $file) {
      $title = $name . ' - ';
      break;
    }
  }
  $title = $title . "INFO 2300";
  echo htmlspecialchars($title);
}

?>
