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

    <!-- Cash reconciliation iframe -->
    <div class="iframe-container" id="cash-reconciliation-container">
      <iframe id="cash-reconciliation-frame" src="cash-reconciliation.php" width="400px" height="400px"></iframe>
    </div>

    <!-- Create new item iframe -->
    <div class="iframe-container" id="create-new-item-container">
      <iframe id="create-new-item-frame" src="create-new-item.php" width="400px" height="400px"></iframe>
    </div>

    <!-- Remove item iframe -->
    <div class="iframe-container" id="remove-item-container">
      <iframe id="remove-item-frame" src="remove-item.php" width="400px" height="400px"></iframe>
    </div>

    <div id="left-container">
      <div id="navbar">
        <button type="submit" class="navbutton" id="reconcile-cash">Reconcile</button>
        <button type="submit" class="navbutton" id="create-new-item">New Item</button>
        <button type="submit" class="navbutton" id="remove-item">Delete Item</button>
      </div>

      <div id="buttonMatrix">
        <?php
          $query = "SELECT * FROM items;";
          $result = mysqli_query($conn,$query);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              // Only display active items
              if ($row["active"] == 1) {

                $id = $row["id"];
                $name = $row["name"];
                $price = $row["price"];

                // Generate buttons for each row in items table
                echo "<div class='button' onclick='addToCart(".$id.",\"".$name."\",".$price.")'>";
                echo "<p class='buttonLabel' id='name'>".$name."</p>";
                echo "<p class='buttonLabel' id='price'>$".$price."</p>";
                echo "</div>";

              }
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
          <!-- <div id="eftpos" class="paymentButton"><h1 class="paymentLabel">EFTPOS</h1></div> -->
        </div>
      </div>
    </div>
    <script src="scripts/script.js"></script>
  </body>
</html>
