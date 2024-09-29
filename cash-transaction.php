<?php
  include "dbconn.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total = $_POST["total"];
    $cash_received = $_POST["cash-received"];
    $change_due = $_POST["change-due"];

    $query = "INSERT INTO orders (orderdatetime,ordertotal) VALUES (NOW(),$total)";
    $result = mysqli_query($conn,$query);
  }
?>

<html lang="en-nz">
  <head>
    <meta charset="utf-8">
    <title>Payment</title>
    <link rel="stylesheet" href="stylesheets/cash-transaction.css">
  </head>
  <body>
    <h1>CASH TXN</h1>
    <form method="POST">
      <label for="total">Total Cash Due: $</label>
      <input type="text" name="total" id="total" class="noborder" readonly>
      <br>
      <label for="cash-received">Cash Received: $</label>
      <input type="text" class="noborder" id="cash-received" name="cash-received" placeholder="0.00" step="0.01" oninput="validate()" pattern="^[\d]+(\.[\d])?[\d]?$" style="margin-bottom:20px;" required>
      <br>
      <label for="change-due">Change Due:</label>
      <br>
      <input type="text" id="change-due" name="change-due" placeholder="$0.00" class="noborder" readonly></input>
      <br>
      <button type="submit" id="process-transaction-button" onclick="processTransaction()" disabled>Process Transaction</button>
      <button type="reset" id="cancel-transaction-button" onclick="window.parent.document.getElementById('payment-container').classList.remove('show');">Cancel Transaction</button>
    </form>

    <script src="scripts/cash-transaction.js"></script>
  </body>
</html>
