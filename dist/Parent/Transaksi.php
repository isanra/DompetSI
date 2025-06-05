<?php
session_start();
include_once '../../php/conn.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['santri_id'])) {
  header("Location: ../../php/logout.php"); // redirect kalau tidak login
  exit;
}

$santri_id = $_SESSION['santri_id'];
$pesan = "";
$saldoLama = 0;
$saldoSisa = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jumlah = intval(preg_replace("/[^0-9]/", "", $_POST['jumlah']));

  if ($jumlah <= 0) {
    $pesan = "❌ Jumlah tidak boleh kosong atau nol.";
  } else {
    $tipe = 'masuk';
    $keterangan = 'Isi saldo oleh santri';

    // Cek saldo saat ini
    $saldoQuery = "SELECT total_saldo FROM saldo WHERE santri_id = ?";
    $saldoStmt = $conn->prepare($saldoQuery);
    $saldoStmt->bind_param("i", $santri_id);
    $saldoStmt->execute();
    $saldoResult = $saldoStmt->get_result();

    if ($saldoRow = $saldoResult->fetch_assoc()) {
      $saldoLama = $saldoRow['total_saldo'];
      $saldoSisa = $saldoLama + $jumlah;

      // Simpan ke riwayat
      $riwayatQuery = "INSERT INTO riwayat (santri_id, jumlah, tipe, keterangan) 
                       VALUES (?, ?, ?, ?)";
      $riwayatStmt = $conn->prepare($riwayatQuery);
      $riwayatStmt->bind_param("iiss", $santri_id, $jumlah, $tipe, $keterangan);
      $riwayatStmt->execute();

      // Update saldo
      $updateSaldo = "UPDATE saldo SET total_saldo = ?, updated_at = NOW() WHERE santri_id = ?";
      $updateStmt = $conn->prepare($updateSaldo);
      $updateStmt->bind_param("ii", $saldoSisa, $santri_id);
      $updateStmt->execute();

      $pesan = "✅ Saldo berhasil ditambahkan sebesar Rp " . number_format($jumlah, 0, ',', '.');
    } else {
      $pesan = "❌ Gagal mengambil data saldo.";
    }
  }

  $conn->close();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="/src/output.css" rel="stylesheet" />
  </head>

  <body class="bg-gray-100 md:overflow-hidden">
    <?php require_once('../../php/sidebar-parent.php'); ?>
    <nav>
      <!-- Mobile Navbar: hanya tampil di HP -->
      <div class="pt-4 ps-4">
        <div class="flex items-center gap-3">
          <!-- Tombol Keluar -->
          <a href="/dist/parent/profil.php">
            <button class="text-2xl font-bold text-gray-500">
              <i class="fa-solid fa-arrow-left"></i>
            </button>
          </a>

          <!-- Judul Riwayat -->
          <h4 class="text-lg md:text-3xl ps-3 md:hidden text-gray-600 font-bold">Isi Saldo</h4>
        </div>
      </div>
    </nav>

    

     <!-- Main Konten -->
     <div class="p-6 sm:ml-64 md:mt-8">
      <div class="md:bg-white md:p-6 md:ps-8 md:shadow-md rounded-lg rounded-tl-5xl md:h-80 flex flex-col h-full min-h-[520px] md:min-h-[0]">
        <div class="items-center gap-3 mb-10 hidden md:flex">
          <div class="md:w-12 w-14 h-14 md:h-12 flex items-center justify-center rounded-full bg-green-600">
            <i class="fa-solid fa-download text-white text-2xl"></i>
          </div>
          <h2 class="text-5xl font-bold">Isi Saldo</h2>
        </div>

        <?php if (!empty($pesan)): ?>
          <p style="color: <?= strpos($pesan, '✅') !== false ? 'green' : 'red' ?>"><?= $pesan ?></p>
        <?php endif; ?>

        <form class="grow flex flex-col justify-between" method="POST" action="">
          <div>
            <label class="block text-gray-700 font-semibold mb-2">Nominal</label>
            <div class="hidden md:flex items-center gap-2 rounded-2xl">
  <h3 class="text-gray-500 font-bold text-3xl">Rp</h3>
  <input type="text" id="inputNominalDesktop" name="jumlah_desktop" class="text-3xl font-bold text-gray-700 outline-none border-none bg-transparent" placeholder="0" oninput="formatDesktopInput(this)" />
  <input type="hidden" name="jumlah" id="hiddenJumlah" />
</div>


            <div class="flex md:hidden items-center gap-2 rounded-2xl">
              <h3 class="text-gray-500 font-bold text-5xl">Rp</h3>
              <span id="displayNominal" class="text-gray-500 font-bold text-5xl select-none md:hidden">0</span>
            </div>
          </div>

          <!-- NUMPAD -->
          <div class="grid grid-cols-3 gap-4 mt-8 md:hidden">
            <button type="button" class="numpad-btn">1</button>
            <button type="button" class="numpad-btn">2</button>
            <button type="button" class="numpad-btn">3</button>
            <button type="button" class="numpad-btn">4</button>
            <button type="button" class="numpad-btn">5</button>
            <button type="button" class="numpad-btn">6</button>
            <button type="button" class="numpad-btn">7</button>
            <button type="button" class="numpad-btn">8</button>
            <button type="button" class="numpad-btn">9</button>
            <button type="button" class="numpad-btn">0</button>
            <button type="button" class="numpad-btn">000</button>
            <button type="button" class="numpad-btn" id="deleteBtn"><i class="fa-solid fa-delete-left"></i></button>
          </div>

          <!-- Tombol Submit -->
          <button type="submit" class="w-full bg-amber-600 text-white p-3 mt-6 rounded-lg text-lg font-semibold hover:bg-amber-700" onclick="submitJumlah()">Konfirmasi</button>
        </form>
      </div>
    </div>
  </body>
  <script src="/assets/js/parent.js"></script>
  <script>
    function submitJumlah() {
      const nominal = document.getElementById("displayNominal")?.innerText || document.getElementById("inputNominalDesktop")?.value;
      const cleanNominal = nominal.replace(/[^\d]/g, '');
      document.getElementById("hiddenJumlah").value = cleanNominal;
    }

    function submitJumlah() {
    let nominal;
    const isMobile = window.innerWidth < 768;

    if (isMobile) {
      nominal = document.getElementById("displayNominal").innerText;
    } else {
      nominal = document.getElementById("inputNominalDesktop").value;
    }

    const cleanNominal = nominal.replace(/[^\d]/g, '');
    document.getElementById("hiddenJumlah").value = cleanNominal;
  }

  function formatDesktopInput(input) {
    let rawValue = input.value.replace(/[^\d]/g, '');
    input.value = new Intl.NumberFormat('id-ID').format(rawValue);
  }
  </script>
</html>
