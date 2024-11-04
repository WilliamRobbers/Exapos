function validate() {
  // End of day cash tally
  let endAmount = document.getElementById("end-amount");
  // End Day Button
  let endDay = document.getElementById("end-day-button");
  // Pattern replacing anything except digits and decimal points with nothing
  endAmount.value = endAmount.value.replace(/[^0-9.]/g, '');
  // Forcing max decimal input to 2dp
  endAmount.value = endAmount.value.indexOf(".") >= 0 ? endAmount.value.slice(0, endAmount.value.indexOf(".") + 3) : endAmount.value;

  // Get regex pattern from element
  var pattern = endAmount.getAttribute("pattern");
  var regex = new RegExp(pattern, "g")

  // If start amount matches pattern
  if (regex.test(endAmount.value)) {
    // Enable button
    endDay.disabled = false;
  } else { // If start amount doesn't match pattern
    endDay.disabled = true;
  }
}

function endDay() {
  // Send a message to the window parent so that the main script can close the modal
  window.parent.postMessage('closereconmodal', '*');
}
