<?php include "dbconn.php";?>

<html>
  <head>
    <title>Exapos</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>

    <div id="buttonMatrix">
      <?php
        $query = "SELECT * FROM items;";
        $result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

            $id = $row["id"];
            $name = $row["name"];
            $price = $row["price"];

            //Generate buttons for each row in items table
            echo "<div class='button' onclick='addToCart(".$id.",\"".$name."\",".$price.")'>";
            echo "<p class='buttonLabel'>".$name."</p>";
            echo "<p class='buttonLabel'>$".$price."</p>";
            echo "</div>";

          }
        }
      ?>
    </div>

    <div id="rightDiv">
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
          <h1>TOTAL: $<span id="orderTotal"></span></h1>
          <div id="cash" class="paymentButton"><h1 class="paymentLabel">CASH</h1></div>
          <div id="eftpos" class="paymentButton"><h1 class="paymentLabel">EFTPOS</h1></div>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
