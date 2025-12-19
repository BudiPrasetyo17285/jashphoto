// ==========================================
// LOGIN SCRIPT - JavaScript Sederhana
// ==========================================

document.addEventListener("DOMContentLoaded", function () {
  // ==========================================
  // 1. FORM VALIDATION
  // ==========================================

  const loginForm = document.querySelector(".login-form");
  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");

  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      let isValid = true;

      // Validasi username
      if (usernameInput.value.trim() === "") {
        alert("Username tidak boleh kosong");
        usernameInput.focus();
        isValid = false;
      }

      // Validasi password
      else if (passwordInput.value === "") {
        alert("Password tidak boleh kosong");
        passwordInput.focus();
        isValid = false;
      }

      // Jika tidak valid, cancel submit
      if (!isValid) {
        e.preventDefault();
      }
    });
  }

  // ==========================================
  // 2. SHOW/HIDE PASSWORD (Optional)
  // ==========================================

  // Tambahkan icon mata di sebelah password input
  const passwordGroup = passwordInput.parentElement;

  // Buat toggle button
  const togglePassword = document.createElement("button");
  togglePassword.type = "button";
  togglePassword.innerHTML = "👁️";
  togglePassword.style.cssText = `
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        opacity: 0.5;
        transition: opacity 0.3s;
    `;

  // Set relative positioning untuk parent
  passwordGroup.style.position = "relative";
  passwordGroup.appendChild(togglePassword);

  // Toggle password visibility
  togglePassword.addEventListener("click", function () {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      togglePassword.innerHTML = "🙈";
      togglePassword.style.opacity = "1";
    } else {
      passwordInput.type = "password";
      togglePassword.innerHTML = "👁️";
      togglePassword.style.opacity = "0.5";
    }
  });

  togglePassword.addEventListener("mouseenter", function () {
    this.style.opacity = "1";
  });

  togglePassword.addEventListener("mouseleave", function () {
    if (passwordInput.type === "password") {
      this.style.opacity = "0.5";
    }
  });

  // ==========================================
  // 3. FOCUS ANIMATION
  // ==========================================

  const inputs = document.querySelectorAll(".form-group input");

  inputs.forEach((input) => {
    // Add class saat focus
    input.addEventListener("focus", function () {
      this.parentElement.classList.add("focused");
    });

    // Remove class saat blur (jika kosong)
    input.addEventListener("blur", function () {
      if (this.value === "") {
        this.parentElement.classList.remove("focused");
      }
    });
  });

  // ==========================================
  // 4. FORGOT PASSWORD LINK
  // ==========================================

  const forgotLink = document.querySelector(".forgot-link");

  if (forgotLink) {
    forgotLink.addEventListener("click", function (e) {
      e.preventDefault();
      alert(
        "Fitur lupa password akan segera tersedia.\n\nUntuk demo, gunakan:\nUsername: admin\nPassword: admin123"
      );
    });
  }

  // ==========================================
  // 5. ENTER KEY SUBMIT
  // ==========================================

  // Submit form dengan menekan Enter di field manapun
  [usernameInput, passwordInput].forEach((input) => {
    input.addEventListener("keypress", function (e) {
      if (e.key === "Enter") {
        loginForm.submit();
      }
    });
  });

  // ==========================================
  // 6. AUTO FILL DEMO CREDENTIALS (Optional)
  // ==========================================

  // Double click pada demo info untuk auto fill
  const demoInfo = document.querySelector(".demo-info");

  if (demoInfo) {
    demoInfo.addEventListener("dblclick", function () {
      usernameInput.value = "admin";
      passwordInput.value = "admin123";

      // Animasi flash
      usernameInput.style.transition = "background-color 0.3s";
      passwordInput.style.transition = "background-color 0.3s";

      usernameInput.style.backgroundColor = "#f0f0f0";
      passwordInput.style.backgroundColor = "#f0f0f0";

      setTimeout(() => {
        usernameInput.style.backgroundColor = "transparent";
        passwordInput.style.backgroundColor = "transparent";
      }, 300);

      alert("Demo credentials telah diisi!\nKlik tombol MASUK untuk login.");
    });

    // Tambah cursor pointer untuk hint
    demoInfo.style.cursor = "pointer";
    demoInfo.title = "Double-click untuk auto fill";
  }

  // ==========================================
  // 7. LOADING STATE SAAT SUBMIT
  // ==========================================

  const submitBtn = document.querySelector(".btn-submit");

  loginForm.addEventListener("submit", function () {
    // Disable button dan ubah text
    submitBtn.disabled = true;
    submitBtn.textContent = "MEMPROSES...";
    submitBtn.style.opacity = "0.7";

    // Note: Dalam aplikasi nyata, ini akan di-handle oleh PHP
    // Setelah redirect, button akan normal kembali
  });

  // ==========================================
  // 8. CONSOLE LOG (Debugging)
  // ==========================================

  console.log("Login page loaded successfully");
  console.log("Demo credentials: admin / admin123");
});

// ==========================================
// CATATAN UNTUK MAHASISWA:
// ==========================================
// 1. Script ini menggunakan JavaScript DASAR
// 2. Semua fitur diberi komentar penjelasan
// 3. Bisa dipresentasikan dengan mudah
// 4. Tidak menggunakan library eksternal
// 5. Validasi sederhana untuk demo
