const iconPassword = document.querySelectorAll(".icon_password");

iconPassword.forEach((iconpass) => {
  const icons = Array.from(iconpass.querySelectorAll(".icon"));

  icons.forEach((icon) => {
    icon.addEventListener("click", (event) => {
      const inputContainer = iconpass.closest(".input");
      const input = inputContainer.querySelector("input");

      // cari posisi icon yang punya class melek
      const currentIndex = icons.findIndex((i) =>
        i.classList.contains("melek")
      );

      // hapus class meleh pada semua icon
      icons.map((i) => i.classList.remove("melek"));

      if (currentIndex === 0) {
        icons[1].classList.add("melek");
        input.type = "text";
      }

      if (currentIndex === 1) {
        icons[0].classList.add("melek");
        input.type = "password";
      }
    });
  });
});
