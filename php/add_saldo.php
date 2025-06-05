<?php
include_once 'conn.php';

$pesan = "";
$showConfirmation = false;
$saldoLama = 0;
$saldoSisa = 0;
$input = $jumlah = $tipe = $keterangan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = $_POST['nama_atau_nis'];
  $jumlah = intval($_POST['jumlah']);
  $tipe = $_POST['tipe'];
  $keterangan = $_POST['keterangan'];
  $force = isset($_POST['force']) ? $_POST['force'] : false;

  $query = "SELECT id FROM santri WHERE nama = ? OR nis = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss", $input, $input);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows === 1) {
    $stmt->bind_result($santri_id);
    $stmt->fetch();

    $saldoQuery = "SELECT total_saldo FROM saldo WHERE santri_id = ?";
    $saldoStmt = $conn->prepare($saldoQuery);
    $saldoStmt->bind_param("i", $santri_id);
    $saldoStmt->execute();
    $saldoResult = $saldoStmt->get_result();

    if ($saldoRow = $saldoResult->fetch_assoc()) {
      $saldoLama = $saldoRow['total_saldo'];
      $saldoSisa = ($tipe === 'masuk') ? $saldoLama + $jumlah : $saldoLama - $jumlah;

      if ($tipe === 'keluar' && $saldoLama < $jumlah && !$force) {
        $showConfirmation = true;
      } else {
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

        $pesan = "✅ Saldo berhasil diperbarui.";
      }
    } else {
      $pesan = "❌ Data saldo tidak ditemukan.";
    }
  } else {
    $pesan = "❌ Santri dengan NIS atau Nama <b>'$input'</b> tidak ditemukan.";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Saldo Santri</title>
</head>
<body>
  <h2>Tambah Saldo Santri</h2>

  <?php if (!empty($pesan)): ?>
    <p style="color: <?= strpos($pesan, '✅') !== false ? 'green' : 'red' ?>"><?= $pesan ?></p>
  <?php endif; ?>

  <form action="add_saldo.php" method="POST">
    <label for="nama_atau_nis">Nama atau NIS Santri:</label>
    <input type="text" name="nama_atau_nis" value="<?= htmlspecialchars($input) ?>" required><br>

    <label for="jumlah">Jumlah Saldo:</label>
    <input type="number" name="jumlah" value="<?= htmlspecialchars($jumlah) ?>" required><br>

    <label for="tipe">Tipe:</label>
    <select name="tipe" required>
      <option value="masuk" <?= $tipe === 'masuk' ? 'selected' : '' ?>>Masuk</option>
      <option value="keluar" <?= $tipe === 'keluar' ? 'selected' : '' ?>>Keluar</option>
    </select><br>

    <label for="keterangan">Keterangan:</label>
    <input type="text" name="keterangan" value="<?= htmlspecialchars($keterangan) ?>" required><br>

    <button type="submit" name="submit">Tambah Saldo</button>
  </form>

  <?php if ($showConfirmation): ?>
    <script>
      if (confirm("❗ Saldo saat ini hanya Rp <?= number_format($saldoLama, 0, ',', '.') ?>. Ingin tetap mengambil Rp <?= number_format($jumlah, 0, ',', '.') ?>?")) {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "addSaldo.php";

        const inputs = {
          nama_atau_nis: "<?= $input ?>",
          jumlah: "<?= $jumlah ?>",
          tipe: "<?= $tipe ?>",
          keterangan: "<?= $keterangan ?>",
          force: "1"
        };

        for (const [name, value] of Object.entries(inputs)) {
          const input = document.createElement("input");
          input.type = "hidden";
          input.name = name;
          input.value = value;
          form.appendChild(input);
        }

        document.body.appendChild(form);
        form.submit();
      } else {
        alert("❌ Transaksi dibatalkan.");
      }
    </script>
  <?php endif; ?>
</body>
</html>