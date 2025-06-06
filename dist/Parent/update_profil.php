<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile View</title>
    <link rel="stylesheet" href="/src/output.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  </head>
  <body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
      <!-- Half Circle Top Right -->
      <div class="hidden md:block md:absolute top-0 right-0 md:w-120 md:h-120 bg-amber-500 rounded-bl-full z-[-1]"></div>

      <!-- Half Circle Bottom Left -->
      <div class="hidden md:block md:absolute bottom-0 left-0 md:w-120 md:h-120 bg-amber-500 rounded-tr-full z-[-1]"></div>

      <div class="max-w-3xl w-full bg-white rounded-xl shadow-lg relative">
        <div class="px-8 py-6">
          <div class="relative mb-8">
            <!-- Tombol Back -->
            <a href="/dist/Parent/Profil.php" class="absolute left-0 top-1/2 -translate-y-1/2">
              <button class="text-2xl font-bold text-gray-500">
                <i class="fa-solid fa-arrow-left"></i>
              </button>
            </a>

            <!-- Judul Tengah -->
            <h2 class="text-3xl font-bold text-black text-center absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2">Profil Santri</h2>

            <!-- Spacer biar tinggi tetap ke-detect -->
            <div class="h-10"></div>
          </div>

          <div class="mb-8 text-center">
            <div class="relative inline-block">
              <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&auto=format&fit=crop&w=150&h=150" alt="Current profile" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200" />
            </div>
          </div>

          <!-- Static View -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block text-xl font-semibold text-black mb-1">Nama Lengkap</label>
              <div class="border-b-2 border-gray-300 pb-1 text-gray-500">Ihsan</div>
            </div>
            <div>
              <label class="block text-xl font-semibold text-black mb-1">Kelas</label>
              <div class="border-b-2 border-gray-300 pb-1 text-gray-500">3 SMA / 2 Pondok</div>
            </div>
            <div id="passwordSection">
              <label class="block text-xl font-semibold text-black mb-1">Password</label>
              <div class="flex items-center justify-between border-b-2 border-gray-300 pb-1 text-gray-500">
                <span id="passwordText">20070112</span>
                <input type="text" id="passwordInput" class="hidden w-full bg-transparent text-gray-500 focus:outline-none" value="20070112" />
                <button id="editBtn" type="button" class="ml-2 text-amber-500 hover:text-amber-700">
                  <!-- icon edit -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                    <path fill-rule="evenodd" d="M4 16a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd" />
                  </svg>
                </button>
              </div>
            </div>

            <div>
              <label class="block text-xl font-semibold text-black mb-1">NISN</label>
              <div class="border-b-2 border-gray-300 pb-1 text-gray-500">1234567890</div>
            </div>
            <div>
              <label class="block text-xl font-semibold text-black mb-1">Tanggal lahir</label>
              <div class="border-b-2 border-gray-300 pb-1 text-gray-500">2007-01-12</div>
            </div>
            <div>
              <label class="block text-xl font-semibold text-black mb-1">QBS / FQ</label>
              <div class="border-b-2 border-gray-300 pb-1 text-gray-500">QBS</div>
            </div>
          </div>
          <!-- Tombol Logout di pojok kiri bawah -->
          <div class="relative">
            <button class="absolute -bottom-3 right-0 bg-red-500 hover:bg-red-600 text-white p-4 rounded-full shadow-lg">
              <p>Keluar Akun <i class="fa-solid fa-right-from-bracket"></i></p>
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
    const editBtn = document.getElementById("editBtn");
    const passwordText = document.getElementById("passwordText");
    const passwordInput = document.getElementById("passwordInput");

    editBtn.addEventListener("click", () => {
      const isEditing = !passwordInput.classList.contains("hidden");

      if (isEditing) {
        // Simpan perubahan
        passwordText.textContent = passwordInput.value;
        passwordInput.classList.add("hidden");
        passwordText.classList.remove("hidden");
        editBtn.innerHTML = `
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
            <path fill-rule="evenodd" d="M4 16a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd" />
          </svg>
        `;
      } else {
        // Ganti jadi input
        passwordInput.classList.remove("hidden");
        passwordText.classList.add("hidden");
        editBtn.innerHTML = `<span class="text-sm">✓</span>`; // icon save simple
        passwordInput.focus();
      }
    });
  </script>
</html>
