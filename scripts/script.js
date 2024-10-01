let cart = []; // Associative array to store cart contents
let total = 0;

// Add new item to cart
function addToCart(itemId, itemName, itemPrice) {
  // Find itemId in cart array
  const itemIndex = cart.findIndex(item => item.itemId === itemId);

  if (itemIndex !== -1) {
    // Item already in cart, increase quantity
    cart[itemIndex].itemQuantity++;
  } else {
    // Item not in cart, add new item
    cart.push({ itemId, itemName, itemPrice, itemQuantity: 1 });
  }

  updateCart();
}

// Remove all items from cart
function clearCart() {
  // Empty the cart and update
  cart = [];
  updateCart();
}

// Remove specific item from cart
function removeItem(itemId) {
  // Find itemId in cart array
  const itemIndex = cart.findIndex(item => item.itemId === itemId);

  // Remove 1 item from cart array starting at itemIndex (remove item at index)
  cart.splice(itemIndex, 1);

  updateCart();
}

// Update cart display on UI
function updateCart() {
  // Variable declarations
  const cartElement = document.getElementById('cart');
  const orderTotalElement = document.getElementById('orderTotal');
  total = 0;

  // Always create header row
  cartElement.innerHTML = `
    <div class="row" id="cartHeaderRow" style="margin-top:10px;">
      <div class="td header" id="clearCartButton" onclick="clearCart()">X</div>
      <div class="td header" style="width:65%">Item</div>
      <div class="td header" style="width:20%">Price</div>
      <div class="td header" style="width:15%">Qty</div>
    </div>
  `;

  // For each item in cart array, create new row on UI
  cart.forEach(item => {
    // Retrieve item details from cart
    let id = item.itemId;
    let name = item.itemName;
    let price = item.itemPrice;
    let qty = item.itemQuantity;

    // Append row to cart with item information
    cartElement.innerHTML += `
      <div class="row" id="${id}">
        <div class="td removeButton" onclick='removeItem(${id})'>X</div>
        <div class="td" style="width:65%">${name}</div>
        <div class="td" style="width:20%">$${price}</div>
        <div class="td" style="width:15%"><input type="number" name="qty" style="width:100%;" value="${qty}" onchange="changeQty(${id}, this.value)" min=1 /></div>
      </div>
    `;

    // Add sum of item price to total
    total += (price * qty);
  });

  // Set order total label to calculated total
  orderTotalElement.textContent = total.toFixed(2);
}

// Change quantity with spinbuttons
function changeQty(itemId, newQty) {
  // Find itemId in cart array
  const itemIndex = cart.findIndex(item => item.itemId === itemId);
  // Update quantity in cart
  cart[itemIndex].itemQuantity = newQty;

  updateCart();
}

// Cash button is pressed
document.getElementById("cash").addEventListener("click", function() {
  // Show payment iframe
  document.getElementById("payment-container").classList.add("show");
  const iframe = document.getElementById("paymentFrame");
  // Set total to order total
  iframe.contentWindow.document.getElementById("total").value = total.toFixed(2);
});

// Reconcile button is pressed
document.getElementById("reconcile-cash").addEventListener("click", function() {
  // Show reconciliation iframe
  document.getElementById("cash-reconciliation-container").classList.add("show");
});

window.addEventListener('message', function(event) {
    // Check for the expected message
    if (event.data === 'clearthecart') {
        clearCart(); // Call the function defined in script.js
    }
});
