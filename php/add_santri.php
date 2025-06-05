<?php
include_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_santri']) && isset($_FILES['foto'])) {
  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];
  $tgl_lahir = $_POST['lahir'];
  $kampus = $_POST['kampus'];
  $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);  

  // Cek apakah sudah ada santri dengan NIS atau Nama yang sama
  $checkQuery = "SELECT id FROM santri WHERE nis = ? OR nama = ?";
  $stmt = $conn->prepare($checkQuery);
  $stmt->bind_param("ss", $nis, $nama);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    echo "❌ Santri dengan NIS atau Nama ini sudah ada!";
  } else {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    $targetDir = "foto/";
    $targetFile = $targetDir . basename($foto);

    if (move_uploaded_file($tmp, $targetFile)) {
      $fotoPath = $foto; // ⬅️ hanya simpan nama file saja
    
      // Simpan ke tabel santri
      $sql = "INSERT INTO santri (nis, nama, kelas, tgl_lahir, kampus, password, foto) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssssss", $nis, $nama, $kelas, $tgl_lahir, $kampus, $pass, $fotoPath);
    
      if ($stmt->execute()) {
        $lastSantriId = $conn->insert_id;

        // Cek apakah saldo sudah ada
        $cekSaldo = $conn->prepare("SELECT id FROM saldo WHERE santri_id = ?");
        $cekSaldo->bind_param("i", $lastSantriId);
        $cekSaldo->execute();
        $cekSaldo->store_result();

        if ($cekSaldo->num_rows === 0) {
          $sqlSaldo = "INSERT INTO saldo (santri_id, total_saldo) VALUES (?, 0)";
          $stmtSaldo = $conn->prepare($sqlSaldo);
          $stmtSaldo->bind_param("i", $lastSantriId);
          $stmtSaldo->execute();
        }

        // Cek apakah riwayat saldo awal sudah ada
        $cekRiwayat = $conn->prepare("SELECT id FROM riwayat WHERE santri_id = ? AND jumlah = 0 AND tipe = 'masuk' AND keterangan = 'Saldo awal'");
        $cekRiwayat->bind_param("i", $lastSantriId);
        $cekRiwayat->execute();
        $cekRiwayat->store_result();

        if ($cekRiwayat->num_rows === 0) {
          $sqlRiwayat = "INSERT INTO riwayat (santri_id, jumlah, tipe, keterangan) VALUES (?, 0, 'masuk', 'Saldo awal')";
          $stmtRiwayat = $conn->prepare($sqlRiwayat);
          $stmtRiwayat->bind_param("i", $lastSantriId);
          $stmtRiwayat->execute();
        }

        // Redirect agar tidak double saat refresh
        header("Location: add_santri.php?success=1");
        exit;
      } else {
        echo "❌ Error simpan santri: " . $conn->error;
      }
    } else {
      echo "❌ Gagal upload foto.";
    }
  }

  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Santri</title>
</head>
<body>

  <?php if (isset($_GET['success'])): ?>
    <p style="color: green;">✅ Data santri berhasil disimpan!</p>
  <?php endif; ?>

  <form action="add_santri.php" method="POST" enctype="multipart/form-data" onsubmit="disableButton()">
    <label for="nis">NIS</label>
    <input type="text" name="nis" placeholder="Masukan NIS" required><br>

    <label for="nama">Nama</label>
    <input type="text" name="nama" placeholder="Masukan Nama" required><br>

    <label for="kelas">Kelas</label>
    <input type="text" name="kelas" placeholder="Masukan Kelas"><br>

    <label for="lahir">Tanggal lahir</label>
    <input type="date" name="lahir"><br>

    <label for="kampus">Kampus</label>
<select name="kampus" required>
  <option value="">-- Pilih Kampus --</option>
  <option value="QBS">QBS</option>
  <option value="FQ">FQ</option>
</select><br>


    <label for="pass">Password</label>
    <input type="password" name="pass" placeholder="Buat Password" required><br>

    <label for="foto">Foto</label>
    <input type="file" name="foto" required><br>

    <button type="submit" name="add_santri" id="submitBtn">Tambah Santri</button>
  </form>

  <script>
    
  </script>
</body>
</html>