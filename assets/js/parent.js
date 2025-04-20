// parent
document.addEventListener("DOMContentLoaded", function () {
  const sidebarLinks = document.querySelectorAll("#logo-sidebar a");

  function setActiveLink() {
    // Hapus kelas aktif dari semua link
    sidebarLinks.forEach((link) => link.classList.remove("sidebar-active"));

    // Cari link yang sesuai dengan halaman saat ini
    sidebarLinks.forEach((link) => {
      if (link.href === window.location.href) {
        link.classList.add("sidebar-active");
      }
    });
  }

  setActiveLink();
});

document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("logo-sidebar");
  const toggleButton = document.querySelector("[data-drawer-toggle='logo-sidebar']");

  toggleButton.addEventListener("click", function () {
    sidebar.classList.toggle("-translate-x-full");
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const displayNominal = document.getElementById("displayNominal");
  const inputDesktop = document.getElementById("inputNominalDesktop");
  const numpadBtns = document.querySelectorAll(".numpad-btn");
  let currentValue = "";

  // Fungsi format angka ke format rupiah
  function formatRupiah(angka) {
    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  // Fungsi update display (dan input desktop biar sinkron)
  function updateDisplay() {
    const formatted = formatRupiah(currentValue || "0");
    displayNominal.textContent = formatted;
    if (inputDesktop) inputDesktop.value = formatted;
  }

  // Event untuk numpad di mobile
  numpadBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const value = btn.textContent.trim();

      if (btn.id === "deleteBtn") {
        currentValue = currentValue.slice(0, -1); // hapus 1 digit
      } else {
        // Tambahkan angka (maks 8 digit biar ga panjang banget)
        if (currentValue.length < 8) {
          currentValue += value;
        }
      }

      currentValue = currentValue.replace(/^0+/, ""); // hapus nol di depan
      updateDisplay();
    });
  });

  // Event input desktop
  if (inputDesktop) {
    inputDesktop.addEventListener("input", () => {
      let raw = inputDesktop.value.replace(/\D/g, ""); // cuma angka
      raw = raw.replace(/^0+/, ""); // hapus nol di depan
      // Batasi input maksimal 8 digit
      if (raw.length <= 8) {
        currentValue = raw;
      } else {
        currentValue = raw.slice(0, 8); // ambil maksimal 8 digit
      }
      updateDisplay();
    });

    inputDesktop.addEventListener("keydown", (e) => {
      // Cegah huruf selain angka & navigasi
      if (!/[0-9]/.test(e.key) && !["Backspace", "ArrowLeft", "ArrowRight", "Delete", "Tab"].includes(e.key)) {
        e.preventDefault();
      }
    });
  }

  // Inisialisasi awal
  updateDisplay();
});
