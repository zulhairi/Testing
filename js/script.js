const formContainer = document.querySelector('.form-container');

const addButton = document.querySelector('.add-travel-btn');
addButton.addEventListener('click', addTravelForm);

const removeButton = document.querySelector('.remove-travel-btn');
removeButton.addEventListener('click', removeTravelForm);
let formCount = 2;
let total = 0;

// Calculate total amount
function calculateTotal() {
  total = 0;
  // Add amount from original form
  const originalAmount = parseInt(document.getElementById('amount').value) || 0;
  total += originalAmount;
  // Add amount from cloned forms
  const clonedForms = formContainer.querySelectorAll('.cloned-form');
  clonedForms.forEach(form => {
    const amount = parseInt(form.querySelector('#amount').value) || 0;
    total += amount;
  });
  // Update total amount element
  const totalAmountElement = document.getElementById('total-amount');
  totalAmountElement.textContent = total;
}

function addTravelForm() {
    const clonedForm = document.getElementById('travelling-form').cloneNode(true);
    const formNumber = clonedForm.querySelector('.form-number2');
    formNumber.textContent = formCount;
  
    // Update the 'id' attributes of the cloned elements
    clonedForm.querySelectorAll('[id]').forEach((element) => {
      element.id = element.id + '-' + formCount;
    });
  
    formCount++;
  
    clonedForm.querySelector('#amount-' + (formCount - 1)).value = "";
    clonedForm.classList.add('cloned-form');
    formContainer.insertBefore(clonedForm, formContainer.querySelector('.form-buttons'));
  
    // Add event listener to the cloned amount input field
    const clonedAmountInput = clonedForm.querySelector('#amount-' + (formCount - 1));
    clonedAmountInput.addEventListener('input', calculateTotal);
  
    calculateTotal();
}

// Add event listener to the original amount input field
const originalAmountInput = document.getElementById('amount');
originalAmountInput.addEventListener('input', calculateTotal);

// Submit form handler
document.getElementById('travelling-form').addEventListener('submit', function(event) {
  event.preventDefault();
  // your form submission code here
});

function removeTravelForm() {
  const clonedForms = formContainer.querySelectorAll('.cloned-form');
  if (clonedForms.length > 0) {
    const lastClonedForm = clonedForms[clonedForms.length - 1];
    formContainer.removeChild(lastClonedForm);
    formCount--;
    calculateTotal();
  }
}

function uncheckOther(clickedCheckbox) {
  // get the other checkbox
  var otherCheckbox = (clickedCheckbox.id === "reimbursable-yes") ? document.getElementById("reimbursable-no") : document.getElementById("reimbursable-yes");
  
  // uncheck the other checkbox
  otherCheckbox.checked = false;
}

const classSelect = document.getElementById('class');
const distanceInput = document.getElementById('distance-travelled');
const amountInput = document.getElementById('amount');

// Add an event listener to the distance input
distanceInput.addEventListener('input', calculateAmount);

// Function to calculate the amount
function calculateAmount() {
  const distance = distanceInput.value;
  let amount = 0;
  
  
  if (classSelect.value === 'car') {
    if (distance <= 500) {
      amount = distance * 0.85;
    } else if (distance >= 501) {
      amount = 500 * 0.85; // First 500 km
      amount += (distance - 500) * 0.75; // After 500 km
    }
  } else if (classSelect.value === 'motorcycle') {
    if (distance <= 500) {
      amount = distance * 0.55;
    } else if (distance >= 501) {
      amount = 500 * 0.55; // First 500 km
      amount += (distance - 500) * 0.45; // After 500 km
    }
  }
  
  // Update the amount input
  amountInput.value = amount.toFixed(2);
}

  