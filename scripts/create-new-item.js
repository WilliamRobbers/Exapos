function validate() {
  // Item name input field
  let itemName = document.getElementById("item-name");
  // Item price input field
  let itemPrice = document.getElementById("item-price");
  // Create Item Button
  let createItem = document.getElementById("create-new-item-button");
  // Pattern replacing anything except digits and decimal points with nothing
  itemPrice.value = itemPrice.value.replace(/[^0-9.]/g, '');
  // Forcing max decimal input to 2dp
  itemPrice.value = itemPrice.value.indexOf(".") >= 0 ? itemPrice.value.slice(0, itemPrice.value.indexOf(".") + 3) : itemPrice.value;

  // Get regex pattern from element
  var pattern = itemPrice.getAttribute("pattern");
  var regex = new RegExp(pattern, "g")

  // If item price matches regex
  if (regex.test(itemPrice.value) && itemName.value.length > 0) {
    // Enable button
    createItem.disabled = false;
  } else { // If item price doesn't match pattern
    createItem.disabled = true;
  }
}

function createItem() {
  window.parent.document.getElementById('create-new-item-container').classList.remove("show");
  // Post a message to the index page
  window.parent.postMessage('refreshbuttonmatrix', '*');
}
