// ============================================
// AUTH SCRIPT - JashPhoto Login System
// ============================================

document.addEventListener("DOMContentLoaded", function () {
  // === ELEMENT REFERENCES ===
  const form = document.querySelector(".auth-form");
  const emailInput = document.querySelector('input[name="email"]');
  const passwordInput = document.querySelector('input[name="password"]');
  const submitBtn = document.querySelector(".btn-submit");
  const alertBox = document.querySelector(".alert");

  // === VALIDASI EMAIL ===
  function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }

  // === VALIDASI PASSWORD ===
  function validatePassword(password) {
    return password.length >= 6;
  }

  // === TAMPILKAN ERROR MESSAGE ===
  function showError(input, message) {
    // Hapus error sebelumnya
    const existingError = input.parentElement.querySelector(".error-message");
    if (existingError) {
      existingError.remove();
    }

    // Tambah border merah
    input.style.borderColor = "rgba(153, 79, 79, 1)";

    // Buat element error
    const errorDiv = document.createElement("div");
    errorDiv.className = "error-message";
    errorDiv.style.color = "#c33";
    errorDiv.style.fontSize = "13px";
    errorDiv.style.marginTop = "5px";
    errorDiv.textContent = message;

    // Tambahkan ke DOM
    input.parentElement.appendChild(errorDiv);
  }

  // === HAPUS ERROR MESSAGE ===
  function clearError(input) {
    const existingError = input.parentElement.querySelector(".error-message");
    if (existingError) {
      existingError.remove();
    }
    input.style.borderColor = "#e0e0e0";
  }

  // === REAL-TIME VALIDATION SAAT TYPING ===
  emailInput.addEventListener("input", function () {
    clearError(this);

    if (this.value && !validateEmail(this.value)) {
      showError(this, "Format email tidak valid");
    }
  });

  passwordInput.addEventListener("input", function () {
    clearError(this);

    if (this.value && !validatePassword(this.value)) {
      showError(this, "Password minimal 6 karakter");
    }
  });

  // === VALIDASI SEBELUM SUBMIT ===
  form.addEventListener("submit", function (e) {
    let isValid = true;

    // Clear semua error
    clearError(emailInput);
    clearError(passwordInput);

    // Validasi Email
    if (!emailInput.value) {
      showError(emailInput, "Email harus diisi");
      isValid = false;
    } else if (!validateEmail(emailInput.value)) {
      showError(emailInput, "Format email tidak valid");
      isValid = false;
    }

    // Validasi Password
    if (!passwordInput.value) {
      showError(passwordInput, "Password harus diisi");
      isValid = false;
    } else if (!validatePassword(passwordInput.value)) {
      showError(passwordInput, "Password minimal 6 karakter");
      isValid = false;
    }

    // Jika tidak valid, cegah submit
    if (!isValid) {
      e.preventDefault();
    } else {
      // Tampilkan loading state
      submitBtn.textContent = "Signing in...";
      submitBtn.disabled = true;
      submitBtn.style.opacity = "0.7";
    }
  });

  // === AUTO HIDE ALERT SETELAH 5 DETIK ===
  if (alertBox) {
    setTimeout(function () {
      alertBox.style.transition = "opacity 0.5s ease";
      alertBox.style.opacity = "0";

      setTimeout(function () {
        alertBox.remove();
      }, 500);
    }, 5000);
  }

  // === ANIMASI SMOOTH FOCUS ===
  const allInputs = document.querySelectorAll(
    'input[type="email"], input[type="password"]'
  );

  allInputs.forEach((input) => {
    input.addEventListener("focus", function () {
      this.parentElement.style.transform = "scale(1.01)";
      this.parentElement.style.transition = "transform 0.2s ease";
    });

    input.addEventListener("blur", function () {
      this.parentElement.style.transform = "scale(1)";
    });
  });

  // === SHOW/HIDE PASSWORD (OPTIONAL) ===
  // Anda bisa menambahkan icon eye di HTML untuk fitur ini
  const togglePassword = document.querySelector(".toggle-password");

  if (togglePassword) {
    togglePassword.addEventListener("click", function () {
      const type =
        passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);

      // Toggle icon (jika menggunakan icon)
      this.textContent = type === "password" ? "👁️" : "👁️‍🗨️";
    });
  }

  // === PREVENT DOUBLE SUBMIT ===
  let isSubmitting = false;

  form.addEventListener("submit", function (e) {
    if (isSubmitting) {
      e.preventDefault();
      return false;
    }
    isSubmitting = true;
  });

  console.log("🎉 JashPhoto Auth Script Loaded!");
});

// ============================================
// UTILITY FUNCTIONS
// ============================================

// Fungsi untuk menampilkan toast notification (optional)
function showToast(message, type = "info") {
  const toast = document.createElement("div");
  toast.className = `toast toast-${type}`;
  toast.textContent = message;
  toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background: ${type === "error" ? "#c33" : "#667eea"};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        z-index: 9999;
        animation: slideIn 0.3s ease;
    `;

  document.body.appendChild(toast);

  setTimeout(() => {
    toast.style.animation = "slideOut 0.3s ease";
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

// CSS Animation untuk toast
const style = document.createElement("style");
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(400px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(400px); opacity: 0; }
    }
`;
document.head.appendChild(style);
