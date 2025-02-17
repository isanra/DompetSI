//heroconst
text = "Selamat Datang Admin, di Rekening Sekolah impian.";
let index = 0;
const typingAnimation = document.getElementById("typing-animation");

function type() {
  if (index < text.length) {
    typingAnimation.innerHTML += text.charAt(index);
    index++;
    setTimeout(type, 50); // Kecepatan animasi
  }
}

type();

