<?php
  include "dbconn.php";

  // Select the float that was added for the current date
  $query = "SELECT * FROM cash_reconciliation WHERE date = CURRENT_DATE()";
  $result = mysqli_query($conn,$query);

  // Store starting float to variable
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $float = $row["start_amount"];
  }

  // Select all orders that were added on the current day
  $query = "SELECT * FROM orders WHERE DATE(orderdatetime) = CURRENT_DATE()";
  $result = mysqli_query($conn,$query);

  $orders_sum = 0;

  // Iteratively calculate sum of all orders
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $orders_sum += $row["ordertotal"];
    }
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $drawer_tally = $_POST["end-amount"];

    // The drawer tally should equal the sum of all orders plus the start of day float
    if ($float + $orders_sum == $drawer_tally) {
      $query = "UPDATE cash_reconciliation SET drawer_total = $drawer_tally, result = 'consistent' WHERE date = CURRENT_DATE()";
      $result = mysqli_query($conn,$query);
    } else {
      $query = "UPDATE cash_reconciliation SET drawer_total = $drawer_tally, result = 'inconsistent' WHERE date = CURRENT_DATE()";
      $result = mysqli_query($conn,$query);
    }
  }
?>

<html lang="en-nz">
  <head>
    <meta charset="utf-8">
    <title>Cash Reconciliation</title>
    <link rel="stylesheet" href="stylesheets/cash-reconciliation.css">
  </head>
  <body>
    <h1>Cash Drawer Tally</h1>
    <form method="POST">
      <label for="cash-float">Start of Day Cash Float:</label>
      <br>
      <input type="text" id="cash-float" class="noborder" value="$<?php echo $float ?>" readonly>
      <br>
      <label for="settlement-total">Total Sales Today:</label>
      <br>
      <input type="text" id="settlement-total" class="noborder" value="$<?php echo $orders_sum ?>" readonly>
      <br>
      <label for="end-amount">Enter cash drawer total: $</label>
      <input type="text" class="noborder" id="end-amount" name="end-amount" placeholder="0.00" step="0.01" oninput="validate()" pattern="^[\d]+(\.[\d])?[\d]?$" style="margin-bottom:20px;" required>
      <br>
      <button type="submit" id="end-day-button" onclick="endDay()" disabled>End day</button>
      <button type="reset" id="cancel-reconciliation-button" onclick="window.parent.document.getElementById('cash-reconciliation-container').classList.remove('show');">Cancel Reconciliation</button>
    </form>

    <script src="scripts/cash-reconciliation.js"></script>
  </body>
</html>
