// Toggle Password Visibility
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("click", function () {
  // Toggle type attribute
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  // Toggle eye icon
  const eyeIcon = this.querySelector(".eye-icon");
  if (type === "text") {
    eyeIcon.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
            <line x1="1" y1="1" x2="23" y2="23"></line>
        `;
  } else {
    eyeIcon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        `;
  }
});

// Form Validation
const loginForm = document.getElementById("loginForm");
const usernameInput = document.getElementById("username");
const alertMessage = document.getElementById("alertMessage");

// Show Alert Function
function showAlert(message, type = "error") {
  alertMessage.textContent = message;
  alertMessage.className = `alert alert-${type}`;
  alertMessage.style.display = "block";

  // Auto hide after 5 seconds
  setTimeout(() => {
    alertMessage.style.display = "none";
  }, 5000);
}

// Hide alert when user starts typing
[usernameInput, passwordInput].forEach((input) => {
  input.addEventListener("input", () => {
    if (alertMessage.style.display === "block") {
      alertMessage.style.display = "none";
    }
  });
});

// Form Submit Handler
loginForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  const username = usernameInput.value.trim();
  const password = passwordInput.value;
  const remember = document.getElementById("remember").checked;

  // Validation
  if (username === "") {
    showAlert("Please enter your username", "warning");
    usernameInput.focus();
    return;
  }

  if (password === "") {
    showAlert("Please enter your password", "warning");
    passwordInput.focus();
    return;
  }

  if (password.length < 6) {
    showAlert("Password must be at least 6 characters", "warning");
    passwordInput.focus();
    return;
  }

  // Show loading state
  const submitButton = loginForm.querySelector(".btn-login");
  submitButton.classList.add("loading");
  submitButton.disabled = true;

  // Simulate API call (Replace with actual API call)
  try {
    // For demonstration - replace with actual fetch to your API
    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);
    formData.append("remember", remember);

    const response = await fetch("process-login.php", {
      method: "POST",
      body: formData,
    });

    const result = await response.json();

    // Remove loading state
    submitButton.classList.remove("loading");
    submitButton.disabled = false;

    if (result.success) {
      showAlert("Login successful! Redirecting...", "success");
      setTimeout(() => {
        window.location.href = result.redirect || "../homepage.php";
      }, 1000);
    } else {
      showAlert(result.message || "Invalid username or password", "error");
    }
  } catch (error) {
    // Remove loading state
    submitButton.classList.remove("loading");
    submitButton.disabled = false;

    console.error("Login error:", error);
    showAlert("An error occurred. Please try again.", "error");
  }
});

// Remember Me - Load saved username
window.addEventListener("DOMContentLoaded", () => {
  const savedUsername = localStorage.getItem("savedUsername");
  if (savedUsername) {
    usernameInput.value = savedUsername;
    document.getElementById("remember").checked = true;
  }
});

// Save username if remember me is checked
document.getElementById("remember").addEventListener("change", function () {
  if (!this.checked) {
    localStorage.removeItem("savedUsername");
  }
});

// Enter key shortcuts
passwordInput.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    loginForm.dispatchEvent(new Event("submit"));
  }
});

// Prevent copy-paste on password field (optional security measure)
// Uncomment if needed
// passwordInput.addEventListener('paste', (e) => {
//     e.preventDefault();
//     showAlert('Pasting is not allowed in password field', 'warning');
// });

// Auto-focus username on page load
window.addEventListener("load", () => {
  if (!usernameInput.value) {
    usernameInput.focus();
  }
});

// Input animations
[usernameInput, passwordInput].forEach((input) => {
  input.addEventListener("focus", function () {
    this.parentElement.classList.add("focused");
  });

  input.addEventListener("blur", function () {
    if (!this.value) {
      this.parentElement.classList.remove("focused");
    }
  });
});

// Log for debugging
console.log("Login page loaded successfully");
console.log("Form validation ready");
