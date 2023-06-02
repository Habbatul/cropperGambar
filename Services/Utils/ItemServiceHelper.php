<?php

require_once __DIR__ . "/../Entity/Item.php";
require_once __DIR__ . "/../Repository/ItemRepository.php";
require_once __DIR__ . "/../Service/ItemService.php";
require_once __DIR__ . "/../Config/Database.php";

use Entity\Item;
use Service\ItemServiceImpl;
use Repository\ItemRepositoryImpl;

// bila nanti fungsi digunakan secara synchronus
function testJsonItem(): object
{
    $connection = \Config\Database::getConnection();
    $itemRepository = new ItemRepositoryImpl($connection);
    $itemService = new ItemServiceImpl($itemRepository);
    $data = $itemService->ShowItem();
    //decode json menjadi object
    return json_decode($data);
}

function testAddItem($gambar, $nama, $deskripsi, $jenis): void
{
    $connection = \Config\Database::getConnection();
    $itemRepository = new ItemRepositoryImpl($connection);
    $itemService = new ItemServiceImpl($itemRepository);

    $itemService->addItem($gambar, $nama, $deskripsi, $jenis);
}

function testRemoveItem($id): void
{
    $connection = \Config\Database::getConnection();
    $itemRepository = new ItemRepositoryImpl($connection);
    $itemService = new ItemServiceImpl($itemRepository);
    
    echo $itemService->removeItem($id);
}

function testChangeItem($id, $gambar, $nama, $deskripsi, $jenis): void
{
    $connection = \Config\Database::getConnection();
    $itemRepository = new ItemRepositoryImpl($connection);
    $itemService = new ItemServiceImpl($itemRepository);

    $itemService->changeItem($id, $gambar, $nama, $deskripsi, $jenis);
}

function testFindGambar($id): string
{
    $connection = \Config\Database::getConnection();
    $itemRepository = new ItemRepositoryImpl($connection);
    $itemService = new ItemServiceImpl($itemRepository);

    return $itemService->findGambar($id);
}

//mencoba pagination
function testJsonPagination($page): object
{
    //setting berapa item yang ingin ditampilkan
    $limit=9; $offset=($page-1)*$limit;
    $connection = \Config\Database::getConnection();
    $itemRepository = new ItemRepositoryImpl($connection);
    $itemService = new ItemServiceImpl($itemRepository);
    $data = $itemService->ShowItemWithPage($limit, $offset);
    //decode json menjadi object
    $decodedData = json_decode($data);
    return $decodedData;
}
?>

