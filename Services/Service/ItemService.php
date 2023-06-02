<?php

namespace Service {

    use Entity\Item;
    use Repository\ItemRepository;

    interface ItemService
    {

        function ShowItem();

        function addItem(string $gambar, string $nama, string $deskripsi, string $jenis): void;

        function removeItem(int $number): void;

        function changeItem(int $id, string $gambar, string $nama, string $deskripsi, string $jenis): void;
        
        function findGambar(int $number): string;
        
        function ShowItemWithPage($limit, $offset);

        
    }

    class ItemServiceImpl implements ItemService
    {
        //nerapin depedency injection sehingga objek diberikan dari luar kelas
        private ItemRepository $itemRepository;

        public function __construct(ItemRepository $itemRepository)
        {
            $this->itemRepository = $itemRepository;
        }

        function ShowItem()
        {
            
            $item = $this->itemRepository->findAll();


            $rows = array_map(function($value) {
                return [
                    'id' => $value->getId(),
                    'gambar' => $value->getGambar(),
                    'nama' => $value->getNama(),
                    'deskripsi' => $value->getDeskripsi(),
                    'jenis' => $value->getJenis(),
                ];
            }, $item);

            $data = array('data' => $rows);
            return json_encode($data);
        }

        function addItem(string $gambar, string $nama, string $deskripsi, string $jenis): void
        {
            $item = new Item($gambar, $nama, $deskripsi, $jenis);
            $this->itemRepository->save($item);
            echo "<script>alert('SUKSES MENAMBAH Item');window.location.href='index';</script>";
        }

        function changeItem(int $id, ?string $gambar, string $nama, string $deskripsi, string $jenis): void
        {
            $this->itemRepository->updateByID($id, $gambar, $nama, $deskripsi, $jenis);
            echo "<script>alert('SUKSES MENGUBAH Item');window.location.href='index';</script>";
        }

        function removeItem(int $number): void
        {
            if ($this->itemRepository->remove($number)) {
                echo "<script>alert('SUKSES MENGHAPUS Item');window.location.href='index';</script>";
            } else {
                echo "<script>alert('GAGAL MENGHAPUS Item');window.location.href='index';</script>";
            }
        }

        function findGambar(int $number): string
        {
            return $this->itemRepository->findGambarByID($number);
        }

        //percobaan pagiantion
        function ShowItemWithPage($limit, $offset)
        {    
            $result = $this->itemRepository->getAll($limit, $offset);
            $page = $this->itemRepository->getPage($limit, $offset);

            $rows = array_map(function($value) {
                return [
                    'id' => $value->getId(),
                    'gambar' => $value->getGambar(),
                    'nama' => $value->getNama(),
                    'deskripsi' => $value->getDeskripsi(),
                    'jenis' => $value->getJenis(),
                ];
            }, $result['data']);
    
            $pagination = $page['pagination'];
    
            $data = array('data' => $rows, 'pagination' => $pagination);
    
            return json_encode($data);
        }

    }

}
