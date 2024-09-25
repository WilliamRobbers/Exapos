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
    <link rel="stylesheet" href="cash-transaction.css">
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

    <script>

    function validate() {
      // Cash received by clerk input
      let cashReceived = document.getElementById("cash-received");
      // Total cash owed
      let total = parseFloat(document.getElementById("total").value);
      // Process Transaction button
      let processTransaction = document.getElementById("process-transaction-button");
      // Pattern replacing anything except digits and decimal points with nothing
      cashReceived.value = cashReceived.value.replace(/[^0-9.]/g, '');
      // Forcing max decimal input to 2dp
      cashReceived.value = cashReceived.value.indexOf(".") >= 0 ? cashReceived.value.slice(0, cashReceived.value.indexOf(".") + 3) : cashReceived.value;

      // Get regex pattern from element
      var pattern = cashReceived.getAttribute("pattern");
      var regex = new RegExp(pattern, "g")

      // If sufficient cash is provided and matches pattern
      if (cashReceived.value >= total && regex.test(cashReceived.value)) {
        // Enable button
        processTransaction.disabled = false;
      } else { // If insufficient cash is provided or does not match pattern
        // Disable button
        processTransaction.disabled = true;
      }
    }

    function processTransaction() {
      // Values
      let total = parseFloat(document.getElementById("total").value) || 0;
      let received = parseFloat(document.getElementById("cash-received").value) || 0;
      // Hide payment iframe
      window.parent.document.getElementById('payment-container').classList.remove('show');
      // Send a message to the window parent so that the main script can clear the cart
      window.parent.postMessage('clearthecart', '*');
    }

    document.getElementById('cash-received').addEventListener('input', function() {
      let total = parseFloat(document.getElementById('total').value) || 0;
      let received = parseFloat(this.value) || 0;
      let change = (received - total).toFixed(2);
      document.getElementById('change-due').value = change >=0 ? `$${change}` : 'Insufficient Funds';
    })
    </script>
  </body>
</html
