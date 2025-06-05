<?php
session_start();
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
          <h4 class="text-lg md:text-3xl ps-3 md:hidden text-gray-600 font-bold">Pembayaran</h4>
        </div>
      </div>
    </nav>

    

    <div class="p-6 sm:ml-64 mt-20">
      <div class="">
        <!-- Form Pengisian Saldo -->

        <!-- Metode Pembayaran dan Ringkasan Transaksi -->
        <div class="md:bg-white md:p-6 md:shadow-md rounded-lg">
          <h2 class="text-2xl font-bold mb-4">Metode Pembayaran</h2>
          <div class="space-y-3 metode-pembayaran flex-grow overflow-auto scrollbar-hide">
            <label class="flex justify-between items-center p-3 rounded-lg cursor-pointer hover:bg-gray-100">
              <div class="flex items-center">
                <img src="/assets/img/bsi.png" alt="BSI" class="w-6 h-6 mr-2" />
                <span class="font-medium">Bank Syariah Indonesia</span>
              </div>
              <input type="radio" name="payment" value="BSI" class="custom-radio" />
            </label>

            <label class="flex justify-between items-center p-3 rounded-lg cursor-pointer hover:bg-gray-100">
              <div>
                <div class="flex items-center">
                  <img src="/assets/img/bca.png" alt="BCA" class="w-6 h-6 mr-2" />
                  <span class="font-medium">BCA Virtual Account</span>
                </div>
              </div>
              <input type="radio" name="payment" value="bca_va" class="custom-radio" />
            </label>
            <label class="flex justify-between items-center p-3 rounded-lg cursor-pointer hover:bg-gray-100">
              <div>
                <div class="flex items-center">
                  <img src="/assets/img/mandiri.png" alt="mandiri" class="w-6 h-6 mr-2" />
                  <span class="font-medium">Mandiri Virtual Account</span>
                </div>
              </div>
              <input type="radio" name="payment" value="mandiri" class="custom-radio" />
            </label>
            <label class="flex justify-between items-center p-3 rounded-lg cursor-pointer hover:bg-gray-100">
              <div>
                <div class="flex items-center">
                  <img src="/assets/img/bni.png" alt="BNI" class="w-6 h-6 mr-2" />
                  <span class="font-medium">BNI Virtual Account</span>
                </div>
              </div>
              <input type="radio" name="payment" value="bni_va" class="custom-radio" />
            </label>
            <label class="flex justify-between items-center p-3 rounded-lg cursor-pointer hover:bg-gray-100">
              <div>
                <div class="flex items-center">
                  <img src="/assets/img/briva.png" alt="BRI" class="w-6 h-6 mr-2" />
                  <span class="font-medium">BRI Virtual Account</span>
                </div>
              </div>
              <input type="radio" name="payment" value="bri_va" class="custom-radio" />
            </label>
          </div>

          <!-- Ringkasan Transaksi -->
          <div class="mt-6 p-4 bg-white shadow-md rounded-lg">
            <h3 class="text-lg font-semibold">Ringkasan transaksi</h3>
            <div class="text-gray-700 mt-2 space-y-2">
              <p>Saldo yang ingin diisi: <span id="saldo" class="font-medium">Rp100.000</span></p>
              <p>Pajak: <span id="pajak" class="font-medium">Rp2.000</span></p>
            </div>
            <hr class="my-4" />
            <p class="text-lg font-bold">Total Tagihan: <span id="total" class="text-amber-600">Rp102.000</span></p>
          </div>

          <!-- Tombol Pembayaran -->
          <button class="w-full bg-amber-500 text-white p-3 mt-4 rounded-lg text-lg font-semibold hover:bg-amber-600">Bayar Sekarang</button>
        </div>
      </div>
    </div>
  </body>
  <script src="/assets/js/parent.js"></script>
</html>
