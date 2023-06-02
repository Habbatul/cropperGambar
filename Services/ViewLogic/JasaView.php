<?php
require_once __DIR__ . '/../Utils/JasaServiceHelper.php';

//Semua kebutuhan front end ada disini
$data=testJsonJasa();


if(isset($_POST['deleteItem']))
{
    testRemoveJasa($_POST['deleteItem']);
}

if(isset($_POST['tambahItem']))
{
    testAddJasa($_POST['pemilik'],$_POST['status'], $_POST['resi'], $_POST['nama_laptop'], $_POST['tanggal']);
}


if(isset($_POST['ubahItem']))
{
    testChangeJasa($_POST['id'], $_POST['pemilik'],$_POST['status'], $_POST['resi'], $_POST['nama_laptop'], $_POST['tanggal']);
}


?>