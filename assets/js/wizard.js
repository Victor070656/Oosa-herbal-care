// Form navigation functions
function nextStep(currentStep) {
  if (validateStep(currentStep)) {
    // Hide current step
    document
      .getElementById(`formStep${currentStep}`)
      .classList.remove("active");
    // Show next step
    document
      .getElementById(`formStep${currentStep + 1}`)
      .classList.add("active");

    // Update progress steps
    document.getElementById(`step${currentStep}`).classList.remove("active");
    document.getElementById(`step${currentStep}`).classList.add("completed");
    document.getElementById(`step${currentStep + 1}`).classList.add("active");
  }
}

function prevStep(currentStep) {
  // Hide current step
  document.getElementById(`formStep${currentStep}`).classList.remove("active");
  // Show previous step
  document.getElementById(`formStep${currentStep - 1}`).classList.add("active");

  // Update progress steps
  document.getElementById(`step${currentStep}`).classList.remove("active");
  document.getElementById(`step${currentStep - 1}`).classList.add("active");
  document
    .getElementById(`step${currentStep - 1}`)
    .classList.remove("completed");
}

function validateStep(step) {
  let isValid = true;
  const currentStep = document.getElementById(`formStep${step}`);

  // Check all required fields in current step
  const requiredFields = currentStep.querySelectorAll("[required]");
  requiredFields.forEach((field) => {
    if (!field.value.trim()) {
      field.classList.add("is-invalid");
      isValid = false;
    } else {
      field.classList.remove("is-invalid");
    }
  });

  // Additional validation for specific steps
  if (step === 3) {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
      document.getElementById("confirmPassword").classList.add("is-invalid");
      alert("Passwords do not match!");
      isValid = false;
    }

    if (password.length < 8) {
      document.getElementById("password").classList.add("is-invalid");
      alert("Password must be at least 8 characters long!");
      isValid = false;
    }
  }

  return isValid;
}

function submitForm() {
  if (validateStep(4)) {
    // Here you would typically send the form data to a server
    alert("Registration successful! Thank you for signing up.");

    // Reset form (optional)
    // document.querySelector('form').reset();

    // Redirect or show success message
    // window.location.href = 'success.html';
  }
}
