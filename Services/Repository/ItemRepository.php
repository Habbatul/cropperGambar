<?php

namespace Repository {

    use Entity\Item;

    interface ItemRepository
    {

        function save(Item $item): void;

        function remove(int $number): bool;

        function findAll(): array;

        function updateByID(int $id, string $gambar, string $nama, string $deskripsi, string $jenis): void;

        function findGambarByID(int $number): string;

        //coba pagination
        function getAll($limit, $offset): array;
    }

    class ItemRepositoryImpl implements ItemRepository
    {


        public array $item = array();

        private \PDO $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }

        function save(Item $item): void
        {

            $sql = "INSERT INTO item(gambar,nama,deskripsi,jenis) VALUES (?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$item->getGambar(),$item->getNama(),$item->getDeskripsi(),$item->getJenis()]);
        }

        // function updateByID(int $id, string $gambar, string $nama, string $deskripsi, string $jenis): void {
        //     $sql = "UPDATE item SET gambar=?, nama=?, deskripsi=?, jenis=?  WHERE id=?";
        //     $statement = $this->connection->prepare($sql);
        //     $statement->execute([$gambar, $nama, $deskripsi, $jenis, $id]);
        // }

        //method menggunakan builder pattern
        function updateByID(int $id, ?string $gambar, string $nama, string $deskripsi, string $jenis): void {
            // Jika $gambar tidak disediakan, ambil nilai kolom gambar dari tabel item
            if (is_null($gambar)) {
                $sql = "SELECT * FROM item WHERE id=?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$id]);
                $item = $statement->fetch();
                $gambar = $item['gambar'];
            }
        
            $sql = "UPDATE item SET gambar=?, nama=?, deskripsi=?, jenis=? WHERE id=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$gambar, $nama, $deskripsi, $jenis, $id]);
        }

        function remove(int $number): bool
        {           
            $sql = "SELECT id FROM item WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()) {
                // todolist ada
                $sql = "DELETE FROM item WHERE id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return true;
            } else {
                // todolist tidak ada
                return false;
            }
        }

        function findAll(): array
        {
            // return $this->todolist;
            $sql = "SELECT * FROM item";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $result = [];

            foreach ($statement as $row) {
                $item = new Item();
                $item->setId($row['id']);
                $item->setGambar($row['gambar']);
                $item->setNama($row['nama']);
                $item->setDeskripsi($row['deskripsi']);
                $item->setJenis($row['jenis']);

                $result[] = $item;
            }

            return $result;
        }

        function findGambarByID(int $number): string
        {
            $sql = "SELECT gambar FROM item WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);
            
            $result = null;
            
            if ($row = $statement->fetch()) {
                $item = new Item();
                $item->setGambar($row['gambar']);
                $result = $item->getGambar();
            }
        
            return $result;
        }

        //percobaan pagination

        // //get berdasarkan limit-offset
        // function getAll($limit, $offset): array
        // {
        //     $sql = "SELECT COUNT(*) as count FROM item";
        //     $countStatement = $this->connection->prepare($sql);
        //     $countStatement->execute();
        //     $totalCount = $countStatement->fetchColumn();

        //     $sql = "SELECT * FROM item LIMIT ?, ?";
        //     $statement = $this->connection->prepare($sql);
        //     $statement->bindValue(1, $offset, \PDO::PARAM_INT);
        //     $statement->bindValue(2, $limit, \PDO::PARAM_INT);
        //     $statement->execute();

        //     $result = [];

        //     foreach ($statement as $row) {
        //         $item = new Item();
        //         $item->setId($row['id']);
        //         $item->setGambar($row['gambar']);
        //         $item->setNama($row['nama']);
        //         $item->setDeskripsi($row['deskripsi']);
        //         $item->setJenis($row['jenis']);

        //         $result[] = $item;
        //     }

        //     $pagination = [
        //         'current_page' => ($offset / $limit) + 1,
        //         'total_pages' => ceil($totalCount / $limit),
        //         'total_items' => $totalCount,
        //         'limit' => $limit
        //     ];

        //     return [
        //         'data' => $result,
        //         'pagination' => $pagination
        //     ];
        // }


        //get berdasarkan limit-offset
        function getAll($limit, $offset): array
        {
            $sql = "SELECT * FROM item ORDER BY id DESC LIMIT ?, ?";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(1, $offset, \PDO::PARAM_INT);
            $statement->bindValue(2, $limit, \PDO::PARAM_INT);
            $statement->execute();

            $result = [];

            foreach ($statement as $row) {
                $item = new Item();
                $item->setId($row['id']);
                $item->setGambar($row['gambar']);
                $item->setNama($row['nama']);
                $item->setDeskripsi($row['deskripsi']);
                $item->setJenis($row['jenis']);

                $result[] = $item;
            }

            return [
                'data' => $result
            ];
        }

        //pagination berdasarkan limit-offset
        function getPage($limit, $offset): array
        {
            $sql = "SELECT COUNT(*) as count FROM item";
            $countStatement = $this->connection->prepare($sql);
            $countStatement->execute();
            $totalCount = $countStatement->fetchColumn();

            $pagination = [
                'current_page' => ($offset / $limit) + 1,
                'total_pages' => ceil($totalCount / $limit),
                'total_items' => $totalCount,
                'limit' => $limit
            ];

            return [
                'pagination' => $pagination
            ];
        }



    }



}
