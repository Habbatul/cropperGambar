<?php

namespace Entity {

    class Jasa
    {

        private int $id;
        private string $pemilik;
        private string $status;
        private string $resi;

        private string $nama_laptop;
        private string $tanggal;



        public function __construct(string $pemilik = "", string $status ="", string $resi="", string $nama_laptop="", string $tanggal="")
        {
            $this->pemilik = $pemilik;
            $this->status= $status;
            $this->resi = $resi;

            $this->nama_laptop = $nama_laptop;
            $this->tanggal = $tanggal;

        }
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getPemilik()
        {
                return $this->status;
        }

        public function setPemilik($pemilik)
        {
                $this->pemilik = $pemilik;

                return $this;
        }

        public function getStatus()
        {
                return $this->status;
        }

        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }

        public function getResi()
        {
                return $this->resi;
        }

        public function setResi($resi)
        {
                $this->resi = $resi;

                return $this;
        }
        public function getNama_laptop()
        {
                return $this->nama_laptop;
        }

        public function setNama_laptop($nama_laptop)
        {
                $this->nama_laptop = $nama_laptop;

                return $this;
        }

        public function getTanggal()
        {
                return $this->tanggal;
        }

        public function setTanggal($tanggal)
        {
                $this->tanggal = $tanggal;

                return $this;
        }
        
    }
        
}
?>