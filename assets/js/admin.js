// sidebar
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

function selectAmount(amount, element) {
  document.getElementById("jumlah").value = amount;

  // Reset semua tombol ke warna default
  document.querySelectorAll(".nominal").forEach((btn) => {
    btn.classList.remove("bg-amber-600", "text-white");
    btn.classList.add("bg-gray-100", "text-amber-600");
  });

  // Tambahkan warna active pada tombol yang diklik
  element.classList.remove("bg-gray-100", "text-amber-600");
  element.classList.add("bg-amber-600", "text-white");
}
