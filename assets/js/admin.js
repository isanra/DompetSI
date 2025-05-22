document.addEventListener("DOMContentLoaded", function () {
  // Aktifkan link sidebar
  const sidebarLinks = document.querySelectorAll("#logo-sidebar a");
  sidebarLinks.forEach((link) => {
    if (link.href === window.location.href) {
      link.classList.add("bg-gray-100", "font-bold", "text-amber-600");
    }
  });

  // Toggle Sidebar
  const sidebar = document.getElementById("logo-sidebar");
  const toggleButton = document.querySelector("[data-drawer-toggle='logo-sidebar']");

    toggleButton?.addEventListener("click", function () {
      if (sidebar.classList.contains("-translate-x-full")) {
        sidebar.classList.remove("-translate-x-full");
        sidebar.classList.add("translate-x-0");
      } else {
        sidebar.classList.remove("translate-x-0");
        sidebar.classList.add("-translate-x-full");
      }   
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
