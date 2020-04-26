<?php
include("includes/init.php");

// Check if the user is logged in to get their bank account information.
if ( is_user_logged_in() ) {

  $db->beginTransaction();
  // Get the bank account information
  $records = exec_sql_query($db,
  "SELECT * FROM bank_accounts WHERE user_id = :user_id;",
  array(':user_id' => $current_user['id'])
  )->fetchAll();
  $bank_account = $records[0];
  $balance = $bank_account['balance'];

  // Did the user request a withdraw?
  if (isset($_POST['withdraw'])) {
    $withdraw = filter_input(INPUT_POST, 'withdraw', FILTER_VALIDATE_FLOAT);

    exec_sql_query($db,
    "UPDATE bank_accounts SET balance = :balance WHERE user_id = :user_id;",
    array(
      ':balance' => $balance - $withdraw,
      ':user_id' => $current_user['id'])
    );
    $balance = $balance - $withdraw;
  }

  $db->commit();

}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
  <?php include("includes/header.php"); ?>

  <div id="content-wrap">
    <h2>Bank of 2300</h2>

    <?php if ( is_user_logged_in() ) { ?>
      <p>
        Current Balance: $<span id="balance"><?php echo number_format($balance, 2, '.', ''); ?></span>
      </p>
      <p>
        Withdraw from Account:
      </p>
      <form method="post" action="bank.php">
        <select name="withdraw" id="money">
          <option value="0">$0</option>
          <option value="20">$20</option>
          <option value="40">$40</option>
          <option value="60">$60</option>
          <option value="80">$80</option>
          <option value="100">$100</option>
        </select>
        <button id="withdraw" type="submit">Withdraw</button>
      </form>
    <?php } else {
      // no user logged in.
      ?>
      <p><strong>You must first login to access your bank account.</strong></p>
      <?php
      include("includes/login.php");
    } ?>

  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
