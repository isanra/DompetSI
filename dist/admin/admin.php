<?php
require_once '../../php/conn.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: /index.php");
  exit();
}

$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$escaped = $conn->real_escape_string($keyword);
$query = "SELECT s.nis, s.nama, s.kelas, s.foto, sa.total_saldo 
          FROM santri s
          JOIN saldo sa ON s.id = sa.santri_id
          WHERE s.nama LIKE '%$escaped%'
          ORDER BY s.nama ASC";


$result = $conn->query($query);

?>



  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
      <link href="/src/output.css" rel="stylesheet" />

      <style></style>
    </head>
    <body id="admin" class="bg-gray-100">
      <?php require_once('../../php/sidebar-admin.php'); ?>
      <div class="flex-1 md:p-6 sm:ml-64 mt-10">
        <div class="container hero-admin mx-auto mt-10 max-w-3xl p-4 sm:p-2">
          <form method="GET" class="relative w-full">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
            <input
              type="text"
              name="search"
              value="<?= htmlspecialchars($keyword) ?>"
              placeholder="Cari santri..."
              class="search-hero w-full p-3 pl-10 rounded-3xl border border-gray-400 shadow-md shadow-gray-600"
            />
          </form>
        </div>
        
        <div class="flex flex-col  p-4">
          <div class="hero-card-santri-admin container mx-auto mt-10 max-h-3xl p-4 sm:p-2 grid grid-cols-1 md:grid-cols-2 gap-4 justify-items-center flex-grow overflow-auto scrollbar-hide">
            <?php if ($result && $result->num_rows > 0): ?>
              <?php while ($row = $result->fetch_assoc()): ?>  
                <a href="santri.php?nis=<?= htmlspecialchars($row['nis']) ?>" class="bg-white p-5 rounded-3xl shadow-md mb-4 flex items-center max-w-md w-full">
                  <?php if (!empty($row['foto'])): ?>
                    <img
                      src="../../php/foto/<?= htmlspecialchars($row['foto']) ?>" alt="Foto <?= $row['nama'] ?>"
                      class="w-16 h-16 rounded-full mr-4"
                    />
                  <?php else: ?>
                    <span>—</span>
                  <?php endif; ?>
                  <div>
                    <h3 class="text-2xl font-bold"><?= htmlspecialchars($row['nama']) ?></h3>
                    <p class="text-gray-600">Kelas <?= htmlspecialchars($row['kelas']) ?></p>
                  </div>
                </a>
              <?php endwhile; ?>
            <?php else: ?>
              <p class="text-center w-full text-gray-500">Belum ada data santri atau saldo.</p>
            <?php endif; ?>
          </div>
        </div>  
      </div>


      <script src="/assets/js/parent.js"></script>
      <script src="/assets/js/admin.js"></script>
    </body>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("logo-sidebar");
        const toggleBtn = document.querySelector("[data-drawer-toggle='logo-sidebar']");

        toggleBtn?.addEventListener("click", function () {
          sidebar.classList.toggle("-translate-x-full");
          sidebar.classList.toggle("translate-x-0");
        });
      });
    </script>

  </html>
</php?>