<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['imageInput']) && isset($_POST['croppedImageData'])) {
    $file = $_FILES['imageInput'];
    $croppedImageData = $_POST['croppedImageData'];

    // Pastikan tidak ada error saat mengunggah file
    if ($file['error'] === UPLOAD_ERR_OK) {
      // Menggunakan nama file untuk tujuan penyimpanan dan tampilan gambar yang dicrop
      $fileName = $file['name'];

      // Decode base64 data gambar yang telah dicrop
      $croppedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));

      // Tentukan path untuk menyimpan gambar yang telah dicrop
      $croppedImagePath = '../ItemGambar/' . $fileName;

      // Simpan gambar yang telah dicrop
      file_put_contents($croppedImagePath, $croppedData);

      // Berhasil mengunggah dan menyimpan gambar yang telah dicrop, lakukan operasi lain jika diperlukan
      // ...

      // Redirect atau tampilkan pesan sukses
      echo 'Gambar berhasil diunggah dan disimpan.';
      echo "<img src='ItemGambar/".$fileName."'>";
      echo "<p>".$_POST['pesan']."</p>";
    } else {
      // Terjadi kesalahan saat mengunggah file
      echo 'Error: ' . $file['error'];
    }
  } else {
    // Tidak ada file yang diunggah atau data gambar yang dicrop tidak tersedia
    echo 'Tidak ada file yang diunggah atau data gambar yang dicrop tidak tersedia.';
  }
}
?>
