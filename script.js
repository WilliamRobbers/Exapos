let cart = [];

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

// Update cart display on UI
function updateCart() {
  // Variable declarations
  const cartElement = document.getElementById('cart');
  const orderTotalElement = document.getElementById('orderTotal');
  let total = 0;

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
    let price = item.itemPrice.toFixed(2);
    let qty = item.itemQuantity;

    // Append row to cart with item information
    cartElement.innerHTML += `
      <div class="row" id="${id}">
        <div class="td removeButton" onclick='removeItem(${id})'>X</div>
        <div class="td" style="width:65%">${name}</div>
        <div class="td" style="width:20%">$${price}</div>
        <div class="td" style="width:15%">${qty}</div>
      </div>
    `;

    // Add sum of item price to total
    total += (price * qty);
  });

  // Set order total label to calculated total
  orderTotalElement.textContent = total;
}

function clearCart() {
  // Empty the cart and update
  cart = [];
  updateCart();
}

function removeItem(itemId) {
  // Find itemId in cart array
  const itemIndex = cart.findIndex(item => item.itemId === itemId);

  // Remove 1 item from cart array starting at itemIndex
  cart.splice(itemIndex, 1);

  updateCart();
}
