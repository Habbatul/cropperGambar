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
  
  <form id="uploadForm" enctype="multipart/form-data" action="proses.php" method="POST">
    <div class="cropper-container">
      <img id="image">
      <canvas id="croppedCanvas"></canvas>
    </div>
  
    <button type="submit" name="saveButton">Simpan</button>
    <input type="hidden" id="croppedImageData" name="croppedImageData">
    <input type="file" id="imageInput" name="imageInput" accept="image/*" onchange="loadImage(event)">

    <input type="text" name="pesan">
  </form>
  
  <script src="src/cropper.js"></script>
  <script>
    //butuh form id=uploadForm, input : {hidden id=croppedImageData, file id=imageInput} 
    var image = document.getElementById('image');
    var cropper;
    var croppedImageDataInput = document.getElementById('croppedImageData');
    
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
        var croppedImageData = canvas.toDataURL('image/jpeg');
        croppedImageDataInput.value = croppedImageData;

        uploadForm.submit();
      }
    });
  </script>
</body>
</html>
