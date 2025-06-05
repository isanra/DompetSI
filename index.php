<?php
session_start();
include_once 'php/conn.php';

if (isset($_POST["masuk"])) {
    $username = trim($_POST["nama"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT id, nama, password, kampus FROM santri WHERE nama = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['santri_id']   = $row['id'];
            $_SESSION['santri_nama'] = $row['nama'];
            $_SESSION['kampus']      = $row['kampus'];

            // Arahkan ke halaman sesuai role
            if ($row['kampus'] === 'admin') {
                header("Location: dist/admin/admin.php");
            } else {
                header("Location: dist/parent/profil.php");
            }
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Nama santri tidak ditemukan.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="/src/output.css" />
    <title>DompetSI | Masuk</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="POST"class="sign-in-form">
            <h2 class="title">Masuk</h2>
            <div class="input-field">
              <i class="fa-solid fa-user"></i>
              <input type="text" name="nama" placeholder="Nama Santri" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" />
            </div>
            <input type="submit" name="masuk" value="Masuk" class="btn solid" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content ">
            <h5 class="text-4xl md:text-7xl font-semibold">DompetSI</h5>
            <p>Sistem digital pintar untuk mencatat, menyimpan, dan mengelola uang saku santri di Sekolah Impian.</p>
          </div>
          <img src="/assets/img/6d6374e6-dafa-4f5d-8e45-b748c1ec958d.png" class="image  alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
