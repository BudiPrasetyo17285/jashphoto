// kategori-script.js

// Hamburger Menu Toggle
const hamburger = document.getElementById("hamburger");
const navMenu = document.querySelector(".nav-menu");

if (hamburger) {
  hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("active");
  });

  // Close menu when clicking outside
  document.addEventListener("click", (e) => {
    if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
      navMenu.classList.remove("active");
    }
  });

  // Close menu when link is clicked
  const navLinks = document.querySelectorAll(".nav-menu a");
  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      navMenu.classList.remove("active");
    });
  });
}

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const href = this.getAttribute("href");
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

// Scroll Animation for Cards
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

// Observe all cards
const cards = document.querySelectorAll(".fotografer-card");
cards.forEach((card, index) => {
  // Add stagger effect
  card.style.transitionDelay = `${index * 0.1}s`;
  observer.observe(card);
});

// WhatsApp Button Click Tracking
const whatsappButtons = document.querySelectorAll(".btn-whatsapp");
whatsappButtons.forEach((btn) => {
  btn.addEventListener("click", function (e) {
    const fotograferName =
      this.closest(".fotografer-card").querySelector("h3").textContent;
    console.log(`WhatsApp clicked for: ${fotograferName}`);

    // Optional: Send analytics
    // ga('send', 'event', 'WhatsApp', 'click', fotograferName);
  });
});

// Detail Button Click Tracking
const detailButtons = document.querySelectorAll(".btn-detail");
detailButtons.forEach((btn) => {
  btn.addEventListener("click", function (e) {
    const fotograferName =
      this.closest(".fotografer-card").querySelector("h3").textContent;
    console.log(`Detail viewed for: ${fotograferName}`);
  });
});

// Search Form Enhancement
const searchForm = document.querySelector(".search-form");
const searchInput = searchForm
  ? searchForm.querySelector('input[name="search"]')
  : null;

if (searchInput) {
  // Auto-submit on Enter
  searchInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      searchForm.submit();
    }
  });

  // Clear search button
  if (searchInput.value) {
    const clearBtn = document.createElement("button");
    clearBtn.type = "button";
    clearBtn.innerHTML = "✕";
    clearBtn.className = "clear-search";
    clearBtn.style.cssText = `
            position: absolute;
            right: 60px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            font-size: 18px;
            padding: 5px;
        `;

    const searchBox = document.querySelector(".search-box");
    searchBox.style.position = "relative";
    searchBox.appendChild(clearBtn);

    clearBtn.addEventListener("click", () => {
      searchInput.value = "";
      searchForm.submit();
    });
  }
}

// Category Pills Horizontal Scroll with Mouse Wheel
const categoryPills = document.querySelector(".category-pills");
if (categoryPills) {
  categoryPills.addEventListener("wheel", (e) => {
    if (e.deltaY !== 0) {
      e.preventDefault();
      categoryPills.scrollLeft += e.deltaY;
    }
  });
}

// Navbar Shadow on Scroll
const navbar = document.querySelector(".navbar");
let lastScroll = 0;

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;

  if (currentScroll > 50) {
    navbar.style.boxShadow = "0 2px 20px rgba(0,0,0,0.15)";
  } else {
    navbar.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
  }

  lastScroll = currentScroll;
});

// Lazy Loading Images
if ("IntersectionObserver" in window) {
  const imageObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        if (img.dataset.src) {
          img.src = img.dataset.src;
          img.removeAttribute("data-src");
        }
        img.classList.add("loaded");
        imageObserver.unobserve(img);
      }
    });
  });

  const lazyImages = document.querySelectorAll("img[data-src]");
  lazyImages.forEach((img) => imageObserver.observe(img));
}

// Rating Badge Animation on Hover
const ratingBadges = document.querySelectorAll(".rating-badge");
ratingBadges.forEach((badge) => {
  badge.addEventListener("mouseenter", function () {
    this.style.transform = "scale(1.1) rotate(-5deg)";
  });

  badge.addEventListener("mouseleave", function () {
    this.style.transform = "scale(1) rotate(0deg)";
  });
});

// Back to Top Button (Optional)
const createBackToTopButton = () => {
  const btn = document.createElement("button");
  btn.innerHTML = "↑";
  btn.className = "back-to-top";
  btn.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        z-index: 1000;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
    `;

  document.body.appendChild(btn);

  window.addEventListener("scroll", () => {
    if (window.pageYOffset > 300) {
      btn.style.opacity = "1";
      btn.style.visibility = "visible";
    } else {
      btn.style.opacity = "0";
      btn.style.visibility = "hidden";
    }
  });

  btn.addEventListener("click", () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });
};

// Initialize back to top button
createBackToTopButton();

// Price Formatting (if needed for dynamic content)
function formatPrice(price) {
  return "Rp " + new Intl.NumberFormat("id-ID").format(price);
}

// Console Log for Debugging
console.log("JashPhoto Kategori Page Loaded");
console.log("Total fotografer cards:", cards.length);

// Error Handler for Images
document.querySelectorAll(".card-image img").forEach((img) => {
  img.addEventListener("error", function () {
    this.src = "https://via.placeholder.com/400x250?text=No+Image";
  });
});
