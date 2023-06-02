<?php

namespace Repository {

    use Entity\Jasa;

    interface JasaRepository
    {

        function save(Jasa $jasa): void;

        function remove(int $number): bool;

        function findAll(): array;

        function updateByID(int $id, string $pemilik, string $status, string $resi, string $nama_laptop, string $tanggal): void;

    }

    class JasaRepositoryImpl implements JasaRepository
    {


        public array $jasa = array();

        private \PDO $connection;

        public function __construct(\PDO $connection)
        {
            $this->connection = $connection;
        }

        function save(Jasa $jasa): void
        {

            $sql = "INSERT INTO jasa(pemilik, status, resi, nama_laptop, tanggal) VALUES (?,?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$jasa->getPemilik(),$jasa->getStatus(),$jasa->getResi(),$jasa->getNama_laptop(), $jasa->getTanggal()]);
        }

        function updateByID(int $id, string $pemilik, string $status, string $resi, string $nama_laptop, string $tanggal): void {
            $sql = "UPDATE jasa SET pemilik=?, status=?, resi=?, nama_laptop=?, tanggal=? WHERE id=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$pemilik, $status, $resi, $nama_laptop, $tanggal, $id]);
        }

        function remove(int $number): bool
        {           
            $sql = "SELECT id FROM jasa WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()) {
                // todolist ada
                $sql = "DELETE FROM jasa WHERE id = ?";
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
            $sql = "SELECT * FROM jasa";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $result = [];

            foreach ($statement as $row) {
                $jasa = new Jasa();
                $jasa->setId($row['id']);
                $jasa->setPemilik($row['pemilik']);
                $jasa->setStatus($row['status']);
                $jasa->setResi($row['resi']);
                $jasa->setNama_laptop($row['nama_laptop']);
                $jasa->setTanggal($row['tanggal']);

                $result[] = $jasa;
            }

            return $result;
        }


    }



}
