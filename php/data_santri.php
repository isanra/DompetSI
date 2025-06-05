<?php
include_once 'conn.php';

// Ambil data santri yang memiliki saldo
$query = "SELECT s.nis, s.nama, s.kelas, s.foto, s.password, sa.total_saldo 
          FROM santri s
          JOIN saldo sa ON s.id = sa.santri_id
          ORDER BY s.nama ASC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Saldo Santri</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    thead {
      background-color: #007bff;
      color: white;
    }
    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
    }
    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <h2>Daftar Saldo Santri</h2>
  <table>
    <thead>
      <tr>
        <th>NIS</th>
        <th>Nama</th>
        <th>Password</th>
        <th>Kelas</th>
        <th>Saldo (Rp)</th>
        <th>Foto</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nis']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['password']) ?></td>
            <td><?= htmlspecialchars($row['kelas']) ?></td>
            <td><?= number_format($row['total_saldo'], 0, ',', '.') ?></td>
            <td>
              <?php if (!empty($row['foto'])): ?>
                <img src="foto/<?= htmlspecialchars($row['foto']) ?>" alt="Foto <?= $row['nama'] ?>">
              <?php else: ?>
                <span>—</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5">Belum ada data santri atau saldo.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>

<?php $conn->close(); ?>
