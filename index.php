<?php
  include "dbconn.php";

  // Query the cash_reconciliation table to see if days float has started
  $query = "SELECT * FROM cash_reconciliation WHERE date = CURRENT_DATE()";
  $result = mysqli_query($conn,$query);

  // Record exists for current date
  if (mysqli_num_rows($result) > 0) {
    // Log info
    echo "<script>console.log('Current date record exists');</script>";
  } else {
    // Show cash float iframe
    echo "<script>window.onload = () => {document.getElementById('cash-float-container').classList.add('show')};</script>";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Select the float that was added for the current date
    $query = "SELECT * FROM cash_reconciliation WHERE date = CURRENT_DATE()";
    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $float = $row["start_amount"];
    }

    // Select all orders that were added on the current day
    $query = "SELECT * FROM orders WHERE DATE(orderdatetime) = CURRENT_DATE()";
    $result = mysqli_query($conn,$query);

    $orders_sum = 0;

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $orders_sum += $row["ordertotal"];
      }
    }

    $query = "UPDATE cash_reconciliation SET tally = $orders_sum WHERE date = CURRENT_DATE()";
    $result = mysqli_query($conn,$query);
  }
?>

<html lang="en-nz">
  <head>
    <meta charset="utf-8">
    <title>Exapos</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <!-- iframe for cash payment -->
    <div class="iframe-container" id="payment-container">
      <iframe id="paymentFrame" src="cash-transaction.php" width="400px" height="400px"></iframe>
    </div>

    <!-- Start of day cash float iframe -->
    <div class="iframe-container" id="cash-float-container">
      <iframe id="cash-float-frame" src="cash-float.php" width="400px" height="400px"></iframe>
    </div>

    <div id="left-container">
      <div id="navbar">
        <form method="POST">
          <button type="submit" class="navbutton" id="reconcile-cash">Reconcile</button>
        </form>
      </div>

      <div id="buttonMatrix">
        <?php
          $query = "SELECT * FROM items;";
          $result = mysqli_query($conn,$query);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

              $id = $row["id"];
              $name = $row["name"];
              $price = $row["price"];

              // Generate buttons for each row in items table
              echo "<div class='button' onclick='addToCart(".$id.",\"".$name."\",".$price.")'>";
              echo "<p class='buttonLabel'>".$name."</p>";
              echo "<p class='buttonLabel'>$".$price."</p>";
              echo "</div>";

            }
          }
        ?>
      </div>
    </div>

    <div id="right-container">
      <div id="checkout"> <!-- Entire white checkout div -->
        <div id="order"> <!-- Top portion of checkout div (right hand side) that holds the current cart / order -->
          <div id="cart">

            <!-- Header Row -->
            <div class="row" id="cartHeaderRow" style="margin-top:10px;">
              <div class="td header" id="clearCartButton" onclick="clearCart()">X</div>
              <div class="td header" style="width:65%">Item</div>
              <div class="td header" style="width:20%">Price</div>
              <div class="td header" style="width:15%">Qty</div>
            </div>

          </div>
        </div>
        <div id="payment"> <!-- Bottom portion of checkout div (right hand side) that holds the payment options and total -->
          <h1>TOTAL: $<span id="orderTotal">0</span></h1>
          <div id="cash" class="paymentButton"><h1 class="paymentLabel">CASH</h1></div>
          <div id="eftpos" class="paymentButton"><h1 class="paymentLabel">EFTPOS</h1></div>
        </div>
      </div>
    </div>
    <script src="scripts/script.js"></script>
  </body>
</html>
