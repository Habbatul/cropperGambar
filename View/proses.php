<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['imageInput']) && isset($_POST['croppedImageData'])) {
    $file = $_FILES['imageInput'];
    $croppedImageData = $_POST['croppedImageData'];

    // Pastikan tidak ada error saat mengunggah file
    if ($file['error'] === UPLOAD_ERR_OK) {
      // Tentukan path penyimpanan akhir
      $targetPath = '../ItemGambar/' . $file['name'];

      // Pindahkan file yang diunggah ke folder tujuan
      if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        // Berhasil memindahkan file yang diunggah

        // Decode base64 data gambar yang telah dicrop
        $croppedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));

        // Tentukan path untuk menyimpan gambar yang telah dicrop
        $croppedImagePath = '../ItemGambar/' . $file['name'];

        // Simpan gambar yang telah dicrop
        file_put_contents($croppedImagePath, $croppedData);

        // Berhasil mengunggah dan menyimpan gambar yang telah dicrop, lakukan operasi lain jika diperlukan
        // ...

        // Redirect atau tampilkan pesan sukses
        echo 'Gambar berhasil diunggah dan disimpan.';
      } else {
        // Gagal memindahkan file yang diunggah
        echo 'Gagal memindahkan file yang diunggah.';
      }
    } else {
      // Terjadi kesalahan saat mengunggah file
      echo 'Error: ' . $file['error'];
    }
  } else {
    // Tidak ada file yang diunggah atau data gambar yang dicrop tidak tersedia
    echo 'Tidak ada file yang diunggah atau data gambar yang dicrop tidak tersedia.';
    echo "<img src='ItemGambar/".$file['name']."'>";
  }
}
?>