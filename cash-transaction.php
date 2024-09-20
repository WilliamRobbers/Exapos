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
      <label for="cash-due">Total Cash Due:</label>
      <input type="text" name="total" id="total" class="noborder" readonly>
      <br>
      <label for="cash-received">Cash Received: $</label>
      <input type="text" id="cash-received" name="cash-received" placeholder="0.00" step="0.01" oninput="validate()"  min="0" pattern="^[\d]+(\.[\d])?[\d]?" required>
      <br>
      <label for="change-due">Change Due:</label>
      <input type="text" id="change-due" name="change-due" placeholder="$0.00" class="noborder" readonly></input>
      <br>
      <button type="submit" onclick="window.parent.document.getElementById('payment-container').classList.remove('show');">Process Transaction</button>
      <button type="reset" onclick="window.parent.document.getElementById('payment-container').classList.remove('show');">Cancel Transaction</button>
    </form>

    <script>
    function validate() {
      // Cash received by clerk input
      let cashReceived = document.getElementById("cash-received");
      // Pattern replacing anything except digits and decimal points with nothing
      cashReceived.value = cashReceived.value.replace(/[^0-9.]/g, '');
      // Forcing max decimal input to 2dp
      cashReceived.value = cashReceived.value.indexOf(".") >= 0 ? cashReceived.value.slice(0, cashReceived.value.indexOf(".") + 3) : cashReceived.value;
    }

      document.getElementById('cash-received').addEventListener('input', function() {
        const total = parseFloat(document.getElementById('total').value) || 0;
        const received = parseFloat(this.value) || 0;
        const change = (received - total).toFixed(2);
        document.getElementById('change-due').value = change >=0 ? `$${change}` : 'Insufficient Funds';
      })
    </script>
  </body>
</html
