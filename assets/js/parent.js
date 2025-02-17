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
  