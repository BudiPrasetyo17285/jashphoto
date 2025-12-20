const navbar = document.querySelector(".header");

window.addEventListener("scroll", (e) => {
  const height = window.innerHeight;
  const navdimmension = navbar.getBoundingClientRect();
  const limit = height - navdimmension.height - 30;

  console.log({ cek: window.scrollY, limit });
  if (window.scrollY > limit) {
    navbar.style.backgroundColor = "#000";
  } else {
    navbar.style.backgroundColor = "transparent";
  }
});
