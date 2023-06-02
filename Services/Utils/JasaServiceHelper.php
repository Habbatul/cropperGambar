<?php

require_once __DIR__ . "/../Entity/Jasa.php";
require_once __DIR__ . "/../Repository/JasaRepository.php";
require_once __DIR__ . "/../Service/JasaService.php";
require_once __DIR__ . "/../Config/Database.php";

use Entity\Jasa;
use Service\JasaServiceImpl;
use Repository\JasaRepositoryImpl;

// bila nanti fungsi digunakan secara synchronus
function testJsonJasa(): object
{
    $connection = \Config\Database::getConnection();
    $jasaRepository = new JasaRepositoryImpl($connection);
    $jasaService = new JasaServiceImpl($jasaRepository);
    $data = $jasaService->ShowJasa();
    //decode json menjadi object
    return json_decode($data);
}

function testAddJasa($pemilik, $status, $resi, $nama_laptop, $tanggal): void
{
    $connection = \Config\Database::getConnection();
    $jasaRepository = new JasaRepositoryImpl($connection);
    $jasaService = new JasaServiceImpl($jasaRepository);

    $jasaService->addJasa($pemilik, $status, $resi, $nama_laptop, $tanggal);
}

function testRemoveJasa($id): void
{
    $connection = \Config\Database::getConnection();
    $jasaRepository = new JasaRepositoryImpl($connection);
    $jasaService = new JasaServiceImpl($jasaRepository);
    
    echo $jasaService->removeJasa($id);
}

function testChangeJasa($id, $pemilik, $status, $resi, $nama_laptop, $tanggal): void
{
    $connection = \Config\Database::getConnection();
    $jasaRepository = new JasaRepositoryImpl($connection);
    $jasaService = new JasaServiceImpl($jasaRepository);

    $jasaService->changeJasa($id, $pemilik, $status, $resi, $nama_laptop, $tanggal);
}

?>

