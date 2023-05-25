<?php
require_once __DIR__ . '/../Utils/ItemServiceHelper.php';

//Semua kebutuhan front end ada disini
$data=testJsonItem();

//coba pagination
if (isset($_GET['page'])) {
    if($_GET['page']==0||ctype_alpha($_GET['page']) ){
        echo "<script>alert('Halaman tidak ada');window.location.href='index'</script>";
    }else{
        $dataPagination = testJsonPagination($_GET['page']);
    }
}else{
    $dataPagination = testJsonPagination(1);
}

//delete di front-end
/* yang dibutuhkan tombol submit name 'deleteItem' dengan value '<?=id>'
input hidden dengan value <?=gambar?> */
if(isset($_POST['deleteItem']))
{
    testRemoveItem($_POST['deleteItem']);
    //untuk menghapus file di folder gambar dengan input gambar yang sesuai id
    $namaFile = $_POST['gambar'];
    $path = "../../itemGambar/";
    $fullPath = $path.$namaFile;
    if (file_exists($fullPath)) {
        unlink($fullPath);
    }
}

//tambah di front end
/* yang dibutuhkan tombol submit name 'tambahItem'
pastikan form adalah enctype="multipart/form-data"
masukkan inputan form sesuai name dibawah ini sesuai dengan table database */
if(isset($_POST['tambahItem']))
{
    $gambar = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $path = "../../itemGambar/";
    move_uploaded_file($tmp_file, $path.$gambar);
    testAddItem($gambar, $_POST['nama'],$_POST['deskripsi'], $_POST['jenis']);
}

//ubah di front end
/* yang dibutuhkan tombol submit name 'ubahItem'
pastikan form adalah enctype="multipart/form-data"
masukkan inputan form sesuai name dibawah ini sesuai dengan table database
yang harus diperhatikan adalah harus ada validasi pada nama, deskripsi, jenis dan pilihan*/
if(isset($_POST['ubahItem']))
{
    if(empty($_FILES['gambar']['name'])){
        $gambar = null;
        testChangeItem($_POST['id'], $gambar, $_POST['nama'],$_POST['deskripsi'], $_POST['jenis']);}
    else{
        //untuk menghapus file di folder gambar dengan input gambar yang sesuai id karena sudah diupdate
        $namaFile = testFindGambar($_POST['id']);
        $path = "../../itemGambar/";
        $fullPath = $path.$namaFile;
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
        
        //laukan update pada seluruhnya dan menerapkan cropper
        if (isset($_FILES['gambar']['name']) && isset($_POST['croppedImageData'])) {
            $gambar = $_FILES['gambar'];
            $croppedImageData = $_POST['croppedImageData'];
        
        
            if ($gambar['error'] === UPLOAD_ERR_OK) {
              $fileName = $gambar['name'];
              $croppedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));
              $croppedImagePath = $path . $fileName;
              file_put_contents($croppedImagePath, $croppedData);
              echo "<script>alert('Gambar berhasil diunggah dan disimpan.');window.location.href='index';</script>";
            } else {
              echo "<script>alert('Error : " . $gambar['error'] . ");window.location.href='index';</script>";
            }
            } else {
            echo "<script>alert('Tidak ada file yang diunggah atau data gambar yang dicrop tidak tersedia.');window.location.href='index';</script>";
            }


        //lakukan query
        testChangeItem($_POST['id'], $gambar['name'], $_POST['nama'],$_POST['deskripsi'], $_POST['jenis']);
    }
}else{
    echo "tolol kau";
}

function SSPagination($dataPagination){

    echo '<ul class="pagination" style="display:flex;align-item:centers;justify-content: center;">';

            $pagination = $dataPagination->pagination;
            $currentPage = $pagination->current_page;
            $totalPages = $pagination->total_pages;
            $limit = 5; // jumlah halaman yang ingin ditampilkan
            $halfLimit = floor($limit / 2); // setengah jumlah halaman (ini untuk tombol ditengah)
    
            if ($currentPage > 1) {
                echo'<li class="page-item"> <a class="page-link" href="?page='.htmlspecialchars($currentPage - 1).'">Prev</a> </li>';
            }
    
            // jika total halaman kurang dari atau sama dengan limit, maka tampilkan tombol halaman sesuai total halaman
            if ($totalPages <= $limit) {
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $currentPage) {
                        echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="?page='.htmlspecialchars($i).'">'.$i.'</a> </li>';
                    } else {
                        echo '<li class="page-item"> <a class="page-link" href="?page='.htmlspecialchars($i).'">'.$i.'</a> </li>';
                    }
                }
            } else {
                // jika halaman lebih dari limit, tampilkan tombol halaman sesuai limit dengan posisi halaman saat ini di tengah
                // tombol halaman
                if ($currentPage <= $halfLimit) {
                    for ($i = 1; $i <= $limit; $i++) {
                        if ($i == $currentPage) {
                            echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="?page='.htmlspecialchars($i).'">'.$i.'</a> </li>';
                        } else {
                            echo '<li class="page-item"> <a class="page-link" href="?page='.htmlspecialchars($i).'">'.$i.'</a> </li>';
                        }
                    }
                } elseif ($currentPage >= ($totalPages - $halfLimit)) {
                    for ($i = $totalPages - $limit + 1; $i <= $totalPages; $i++) {
                        if ($i == $currentPage) {
                            echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="?page='.htmlspecialchars($i).'">'.$i.'</a> </li>';
                        } else {
                            echo '<li class="page-item"> <a class="page-link" href="?page='.htmlspecialchars($i).'">'.$i.'</a> </li>';
                        }
                    }
                } else {
                    for ($i = $currentPage - $halfLimit; $i <= $currentPage + $halfLimit; $i++) {
                        if ($i == $currentPage) {
                            echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="?page='.htmlspecialchars($i).'">'.$i.'</a> </li>';
                        } else {
                            echo '<li class="page-item"> <a class="page-link" href="?page='.htmlspecialchars($i).'">'.$i.'</a> </li>';
                        }
                    }
                }
            }
    
            if ($currentPage < $totalPages) { 
               echo '<li class="page-item"> <a class="page-link" href="?page='.htmlspecialchars($currentPage + 1).'">Next</a> </li>';
            } 
    
    
            echo'</ul>';
}

?>