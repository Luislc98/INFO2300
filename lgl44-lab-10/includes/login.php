<?php
// You may NOT use code for your own login form. You may only reference it when
// writing your own login form.

// This is only one way to implement login, as a template (include). You can
// also implement login by having a dedicated page (http://localhost:3000/login.php)
// Or even having a login form function.

// How you implemented this (as a template, or a dedicated page, function, etc.) is up to you.
// Your design should be based on what makes the most sense for your target
// audience, not what is the most expedient to copy and paste.
?>

<ul>
  <?php
  foreach ($session_messages as $message) {
    echo "<li><strong>" . htmlspecialchars($message) . "</strong></li>\n";
  }
  ?>
</ul>

<form id="loginForm" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
  <ul>
    <li>
      <label for="username">Username:</label>
      <input id="username" type="text" name="username" />
    </li>
    <li>
      <label for="password">Password:</label>
      <input id="password" type="password" name="password" />
    </li>
    <li>
      <button name="login" type="submit">Sign In</button>
    </li>
  </ul>
</form>
