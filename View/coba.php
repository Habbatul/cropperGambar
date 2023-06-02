<!DOCTYPE html>
<html>
<head>
  <title>Cropping Gambar dengan Cropper.js</title>
  <link rel="stylesheet" href="src/cropper.css">
  <style>
    .cropper-container {
      width: 100%;
      max-width: 400px;
      max-height: 400px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <h1>Cropping Gambar dengan Cropper.js</h1>
  
  <form id="uploadForm" enctype="multipart/form-data">
    <div class="cropper-container">
      <img id="image">
      <canvas id="croppedCanvas"></canvas>
    </div>
  
    <button type="submit" name="saveButton">Simpan</button>
    <input type="file" id="imageInput" name="imageInput" accept="image/*" onchange="loadImage(event)">
  </form>
  
  <script src="src/cropper.js"></script>
  <script>
    var image = document.getElementById('image');
    var cropper;
    var formData = new FormData();
    
    function loadImage(event) {
      var input = event.target;
      
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          image.src = e.target.result;
          
          if (cropper) {
            cropper.destroy();
          }
          
          image.onload = function() {
            cropper = new Cropper(image, {
              aspectRatio: 16 / 9
            });
          };
        };
        
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    var uploadForm = document.getElementById('uploadForm');
uploadForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Mencegah aksi default form submit

  if (cropper) {
    var canvas = cropper.getCroppedCanvas();
    canvas.toBlob(function(blob) {
      var formData = new FormData(uploadForm);
      formData.append('croppedImageData', canvas.toDataURL('image/jpeg'));

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Berhasil mengupload gambar yang telah dicrop
            alert('Gambar berhasil diunggah dan disimpan (termasuk hasil cropping).');
          } else {
            // Gagal mengupload gambar yang telah dicrop
            alert('Gagal mengupload gambar yang telah dicrop.');
          }
        }
      };

      xhr.open('POST', 'proses.php', true);
      xhr.send(formData);
    }, 'image/jpeg');
  }
});
  </script>
</body>
</html>