// Hamburger Menu Toggle
const hamburger = document.getElementById("hamburger");
const navMenu = document.getElementById("navMenu");

hamburger.addEventListener("click", () => {
  navMenu.classList.toggle("active");

  // Animasi hamburger menjadi X
  hamburger.classList.toggle("active");
});

// Close menu saat link diklik
const navLinks = document.querySelectorAll(".nav-menu a");
navLinks.forEach((link) => {
  link.addEventListener("click", () => {
    navMenu.classList.remove("active");
    hamburger.classList.remove("active");
  });
});

// Search Functionality
const searchInput = document.getElementById("searchInput");
const btnSearch = document.getElementById("btnSearch");

btnSearch.addEventListener("click", () => {
  const query = searchInput.value.trim();

  if (query === "") {
    alert("Masukkan kata kunci pencarian!");
    return;
  }

  // Redirect ke halaman list dengan query
  window.location.href = `list.php?search=${encodeURIComponent(query)}`;
});

// Enter key untuk search
searchInput.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    btnSearch.click();
  }
});

// Smooth Scroll untuk navigasi
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href");

    // Cek apakah href bukan hanya "#"
    if (href !== "#" && href.length > 1) {
      e.preventDefault();

      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    }
  });
});

// Navbar scroll effect
let lastScroll = 0;
const navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;

  // Tambah shadow saat scroll
  if (currentScroll > 50) {
    navbar.style.boxShadow = "0 2px 20px rgba(0,0,0,0.15)";
  } else {
    navbar.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
  }

  lastScroll = currentScroll;
});

// Active nav link berdasarkan scroll position
const sections = document.querySelectorAll("section[id]");

function activateNavLink() {
  const scrollY = window.pageYOffset;

  sections.forEach((section) => {
    const sectionHeight = section.offsetHeight;
    const sectionTop = section.offsetTop - 100;
    const sectionId = section.getAttribute("id");

    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
      document.querySelectorAll(".nav-menu a").forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href") === `#${sectionId}`) {
          link.classList.add("active");
        }
      });
    }
  });
}

window.addEventListener("scroll", activateNavLink);

// Animasi fade in untuk cards saat scroll
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = "0";
      entry.target.style.transform = "translateY(30px)";

      setTimeout(() => {
        entry.target.style.transition = "all 0.6s ease-out";
        entry.target.style.opacity = "1";
        entry.target.style.transform = "translateY(0)";
      }, 100);

      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observe semua card elements
const cards = document.querySelectorAll(
  ".kategori-card, .fotografer-card, .keunggulan-card, .testimoni-card, .artikel-card"
);
cards.forEach((card) => observer.observe(card));

// Kategori card click effect
const kategoriCards = document.querySelectorAll(".kategori-card");
kategoriCards.forEach((card) => {
  card.addEventListener("click", function (e) {
    // Jika yang diklik bukan link, trigger link click
    if (e.target.tagName !== "A") {
      const link = this.querySelector(".kategori-link");
      if (link) {
        window.location.href = link.href;
      }
    }
  });
});

// Counter animation untuk statistik (jika ada)
function animateCounter(element, target, duration = 2000) {
  let start = 0;
  const increment = target / (duration / 16);

  const timer = setInterval(() => {
    start += increment;
    if (start >= target) {
      element.textContent = target;
      clearInterval(timer);
    } else {
      element.textContent = Math.floor(start);
    }
  }, 16);
}

// Lazy loading images
if ("IntersectionObserver" in window) {
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src || img.src;
        img.classList.add("loaded");
        imageObserver.unobserve(img);
      }
    });
  });

  const images = document.querySelectorAll("img[data-src]");
  images.forEach((img) => imageObserver.observe(img));
}

// Loading animation saat halaman dimuat
window.addEventListener("load", () => {
  document.body.style.opacity = "0";
  setTimeout(() => {
    document.body.style.transition = "opacity 0.5s ease-in";
    document.body.style.opacity = "1";
  }, 100);
});

// Prevent default untuk artikel links (karena masih dummy)
const artikelLinks = document.querySelectorAll(".artikel-link");
artikelLinks.forEach((link) => {
  link.addEventListener("click", (e) => {
    if (link.getAttribute("href") === "#") {
      e.preventDefault();
      alert("Artikel akan segera tersedia!");
    }
  });
});

// Social media links hover effect
const socialIcons = document.querySelectorAll(".social-icon");
socialIcons.forEach((icon) => {
  icon.addEventListener("mouseenter", function () {
    this.style.transform = "scale(1.2) rotate(5deg)";
  });

  icon.addEventListener("mouseleave", function () {
    this.style.transform = "scale(1) rotate(0deg)";
  });
});

// Form validation untuk search (tambahan)
function validateSearch(value) {
  // Minimal 2 karakter
  if (value.length < 2 && value.length > 0) {
    return false;
  }
  return true;
}

searchInput.addEventListener("input", function () {
  const value = this.value.trim();

  if (value.length > 0 && !validateSearch(value)) {
    this.style.borderColor = "#e53e3e";
  } else {
    this.style.borderColor = "";
  }
});

// Tooltip untuk badge rating
const badges = document.querySelectorAll(".fotografer-badge");
badges.forEach((badge) => {
  badge.title = "Rating dari pelanggan";
});

// Console log untuk debugging
console.log("JashPhoto website loaded successfully!");
console.log(
  "Total fotografer cards:",
  document.querySelectorAll(".fotografer-card").length
);
console.log(
  "Total kategori:",
  document.querySelectorAll(".kategori-card").length
);
