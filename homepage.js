// ==========================================
// SCRIPT.JS - JavaScript untuk interaktivitas ringan
// ==========================================

// Menunggu hingga semua elemen HTML selesai dimuat
document.addEventListener("DOMContentLoaded", function () {
  // ==========================================
  // 1. SEARCH BUTTON - Menampilkan alert saat tombol search diklik
  // ==========================================

  const searchBtn = document.querySelector(".search-btn");
  const searchInput = document.querySelector(".search-input");

  searchBtn.addEventListener("click", function () {
    const query = searchInput.value.trim(); // Mengambil nilai input dan menghapus spasi

    if (query === "") {
      alert("Silakan masukkan kata kunci pencarian!");
    } else {
      alert("Mencari fotografer: " + query);
      // Catatan: Ini hanya demo. Di aplikasi nyata, akan redirect ke halaman hasil pencarian
    }
  });

  // Pencarian juga bisa dilakukan dengan menekan Enter
  searchInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      searchBtn.click(); // Trigger klik button search
    }
  });

  // ==========================================
  // 2. KATEGORI CARD - Menampilkan alert saat card kategori diklik
  // ==========================================

  const kategoriCards = document.querySelectorAll(".kategori-card");

  kategoriCards.forEach(function (card) {
    card.addEventListener("click", function () {
      // Mengambil nama kategori dari atribut data-kategori
      const kategori = card.getAttribute("data-kategori");
      const kategoriName = card.querySelector(".kategori-name").textContent;

      alert("Anda memilih kategori: " + kategoriName);
      // Catatan: Di aplikasi nyata, akan redirect ke halaman kategori tersebut
      // window.location.href = 'kategori.php?kategori=' + kategori;
    });
  });

  // ==========================================
  // 3. BUTTON LIHAT DETAIL - Alert saat tombol diklik
  // ==========================================

  const detailButtons = document.querySelectorAll(".btn-detail");

  detailButtons.forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.stopPropagation(); // Mencegah event bubble ke parent

      // Mengambil nama fotografer dari card
      const card = button.closest(".photographer-card");
      const photographerName =
        card.querySelector(".photographer-name").textContent;

      alert("Melihat detail fotografer: " + photographerName);
      // Catatan: Di aplikasi nyata, akan redirect ke halaman detail
      // window.location.href = 'detail.php?id=1';
    });
  });

  // ==========================================
  // 4. SMOOTH SCROLL - Scroll halus saat klik menu navigasi
  // ==========================================

  const navLinks = document.querySelectorAll(".nav-link");

  navLinks.forEach(function (link) {
    link.addEventListener("click", function (e) {
      const href = link.getAttribute("href");

      // Jika link adalah anchor (dimulai dengan #)
      if (href.startsWith("#")) {
        e.preventDefault(); // Mencegah jump langsung

        const targetId = href.substring(1); // Menghilangkan karakter #
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          // Scroll dengan animasi halus
          targetElement.scrollIntoView({
            behavior: "smooth",
            block: "start",
          });
        }
      }
    });
  });

  // ==========================================
  // 5. ACTIVE MENU - Menandai menu yang sedang aktif saat scroll
  // ==========================================

  window.addEventListener("scroll", function () {
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".nav-link");

    let current = "";

    // Mengecek section mana yang sedang terlihat
    sections.forEach(function (section) {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;

      if (window.pageYOffset >= sectionTop - 100) {
        current = section.getAttribute("id");
      }
    });

    // Menambahkan class active pada menu yang sesuai
    navLinks.forEach(function (link) {
      link.classList.remove("active");

      if (link.getAttribute("href") === "#" + current) {
        link.classList.add("active");
      }
    });
  });

  // ==========================================
  // 6. ANIMASI FADE IN - Card muncul dengan animasi saat scroll
  // ==========================================

  // Fungsi untuk mengecek apakah elemen terlihat di viewport
  function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  // Fungsi untuk menambahkan animasi fade in
  function handleScrollAnimation() {
    const cards = document.querySelectorAll(
      ".kategori-card, .photographer-card"
    );

    cards.forEach(function (card) {
      if (isElementInViewport(card)) {
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
      }
    });
  }

  // Set initial state untuk animasi
  const allCards = document.querySelectorAll(
    ".kategori-card, .photographer-card"
  );
  allCards.forEach(function (card) {
    card.style.opacity = "0";
    card.style.transform = "translateY(30px)";
    card.style.transition = "all 0.6s ease";
  });

  // Jalankan animasi saat scroll
  window.addEventListener("scroll", handleScrollAnimation);

  // Jalankan sekali saat halaman dimuat
  handleScrollAnimation();

  // ==========================================
  // 7. CONSOLE LOG - Untuk debugging
  // ==========================================

  console.log("JashPhoto Homepage berhasil dimuat!");
  console.log("Total kategori:", kategoriCards.length);
  console.log("Total fotografer:", detailButtons.length);
});

// ==========================================
// CATATAN UNTUK MAHASISWA:
// ==========================================
// 1. Semua fungsi di atas menggunakan JavaScript DASAR
// 2. Tidak ada library/framework eksternal
// 3. Kode diberi komentar untuk memudahkan pemahaman
// 4. Di aplikasi nyata, alert() akan diganti dengan redirect ke halaman lain
// 5. Struktur kode rapi dan mudah dipresentasikan
