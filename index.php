<?php
session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_santri = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM login WHERE nama_santri = ?");
    $stmt->bind_param("s", $nama_santri);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            // Simpan data user di session
            $_SESSION['loggedin'] = true;
            $_SESSION['nama_santri'] = $user['nama_santri'];
            $_SESSION['id_user'] = $user['id']; // sesuaikan dengan nama kolom ID di DB
            
            if ($user['kategori'] == 'admin') {
              $_SESSION['kategori'] = 'admin';
              header("Location: /dist/admin/admin.php");
          
          } else if ($user['kategori'] == 'santri-qbs') {
              $_SESSION['kategori'] = 'santri-qbs';
              header("Location: /dist/admin/QBS.php");
          
          } else {
              $_SESSION['kategori'] = 'santri-fq';
              header("Location: /dist/admin/FQ.php");
          }
          
            exit();
        } else {
            header("Location: /index.php?error=wrongpass");
            exit();
        }
    } else {
        header("Location: /index.php?error=nouser");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="/dist/masuk/style.css" />
    <link rel="stylesheet" href="/src/output.css" />
    <title>DompetSI | Masuk</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="index.php" method="POST" class="sign-in-form">
            <h2 class="title">Masuk</h2>
            <div class="input-field">
              <i class="fa-solid fa-user"></i>
              <input type="text" name="username" placeholder="Nama Santri" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required />
            </div>
            <input type="submit" value="Masuk" class="btn solid" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <a href="/dist/admin/admin.php">
              <h5 class="text-4xl md:text-7xl font-semibold">DompetSI</h5>
            </a>
            <p>
              Sistem digital pintar untuk mencatat, menyimpan, dan mengelola uang saku santri di Sekolah Impian.
            </p>
          </div>
          <a href="/dist/Parent/Profil.html">
            <img
              src="/assets/img/6d6374e6-dafa-4f5d-8e45-b748c1ec958d.png"
              class="image"
              alt="Gambar Login"
            />
          </a>
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
