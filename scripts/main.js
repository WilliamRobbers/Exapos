let cart = []; // Object array to store cart contents
let total = 0;

// Description: Adds a new item to JS cart object
// Called by: button
// In file: index.php
// Event: onclick
function addToCart(itemId, itemName, itemPrice) {
  const ITEM_INDEX = cart.findIndex(item => item.itemId === itemId);
  itemPrice = itemPrice.toFixed(2);

  if (ITEM_INDEX !== -1) { // If item exists in cart
    cart[ITEM_INDEX].itemQuantity++;
  } else {
    cart.push({ itemId, itemName, itemPrice, itemQuantity: 1 });
  }

  updateCart();
}

// Description: Removes all items from cart
// Called by: clear-cart-button
// In file: index.php
// Event: onclick
function clearCart() {
  cart = [];
  updateCart();
}

// Description: Removes a specific item from cart
// Called by: remove-button
// In file: main.js
// Event: onclick
function removeItem(itemId) {
  const ITEM_INDEX = cart.findIndex(item => item.itemId === itemId);
  cart.splice(ITEM_INDEX, 1);
  updateCart();
}

// Description: Updates the cart display
// Called by: multiple
// In file: main.js
// Event: function call
function updateCart() {
  // Declarations
  const CART_ELEMENT = document.getElementById('cart');
  const ORDER_TOTAL_ELEMENT = document.getElementById('order-total');
  total = 0;

  // Always create header row
  CART_ELEMENT.innerHTML = `
    <div class="row" id="cart-header-row" style="margin-top:10px;">
      <div class="td header" id="clear-cart-button" onclick="clearCart()">X</div>
      <div class="td header" style="width:65%">Item</div>
      <div class="td header" style="width:20%">Price</div>
      <div class="td header" style="width:15%">Qty</div>
    </div>
  `;

  // For each item in cart array, create new row on UI
  cart.forEach(item => {
    let id = item.itemId;
    let name = item.itemName;
    let price = item.itemPrice;
    let qty = item.itemQuantity;

    // Append row to cart with item information
    CART_ELEMENT.innerHTML += `
      <div class="row" id="${id}">
        <div class="td remove-button" onclick='removeItem(${id})'>X</div>
        <div class="td" style="width:65%">${name}</div>
        <div class="td" style="width:20%">$${price}</div>
        <div class="td" style="width:15%"><input type="number" name="qty" style="width:100%;" value="${qty}" onchange="changeQty(${id}, this.value)" min=1 /></div>
      </div>
    `;

    total += (price * qty);
  });

  // Set order total label to calculated total
  ORDER_TOTAL_ELEMENT.textContent = total.toFixed(2);
}

// Description: Changes item quantity with spinbuttons
// Called by: qty input
// In file: main.js
// Event: onchange
function changeQty(itemId, newQty) {
  const itemIndex = cart.findIndex(item => item.itemId === itemId);
  cart[itemIndex].itemQuantity = newQty;
  updateCart();
}

// Cash button is pressed
document.getElementById("cash").addEventListener("click", function() {
  document.getElementById("payment-container").classList.add("show");
  const IFRAME = document.getElementById("payment-frame");
  IFRAME.contentWindow.document.getElementById("cash-received").focus();
  IFRAME.contentWindow.document.getElementById("total").value = total.toFixed(2);
  // Use hidden input to transfer cart object to the iframe
  IFRAME.contentWindow.document.getElementById("cart").value = JSON.stringify(cart);
});

// Reconcile button is pressed
document.getElementById("reconcile-cash").addEventListener("click", function() {
  const IFRAME = document.getElementById("cash-reconciliation-frame");
  // Refresh iframe content
  IFRAME.src += "";
  document.getElementById("cash-reconciliation-container").classList.add("show");
  document.getElementById("cash-reconciliation-frame").contentWindow.document.getElementById("end-amount").focus();
});

// Create new item button is pressed
document.getElementById("create-new-item").addEventListener("click", function() {
  document.getElementById("create-new-item-container").classList.add("show");
})

// Remove item button is pressed
document.getElementById("remove-item").addEventListener("click", function() {
  document.getElementById("remove-item-container").classList.add("show");
  const IFRAME = document.getElementById("remove-item-frame");
  IFRAME.contentWindow.document.getElementById("item-name").focus();
})

window.addEventListener('message', function(event) {
    // Check for the expected messages
    if (event.data === 'clearthecart') {
      clearCart(); // Call the function defined in script.js
      window.location.reload();
    }
    if (event.data === 'refreshbuttonmatrix') {
      setTimeout(function(){ // JS was faster than DB Commit
        window.location.reload(); // Refresh the page
      });
    }
    if (event.data = 'closereconmodal') {
      setTimeout(function(){
        document.getElementById("cash-reconciliation-container").classList.remove("show");
      }, 5000);
    }
});
