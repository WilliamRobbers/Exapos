<html>
  <head>
    <title>Exapos</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div id="buttonMatrix"></div>
    <div id="rightDiv">
      <div id="checkout">
        <div id="order"> <!-- Top portion of checkout div (right hand side) that holds the current cart / order -->

          <div class="row" style="margin-top:10px;">
            <div class="td header" style="width:65%">Item</div>
            <div class="td header" style="width:20%">Price</div>
            <div class="td header" style="width:15%">Qty</div>
          </div>

        </div>
        <div id="payment"> <!-- Bottom portion of checkout div (right hand side) that holds the payment options and total -->
          <h1 id="orderTotal">TOTAL: $xx</h1>
          <div id="cash" class="paymentButton"><h1 class="paymentLabel">CASH</h1></div>
          <div id="eftpos" class="paymentButton"><h1 class="paymentLabel">EFTPOS</h1></div>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
