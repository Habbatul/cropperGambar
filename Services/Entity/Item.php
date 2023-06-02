<?php

namespace Entity {

    class Item
    {

        private int $id;
        private string $gambar;
        private string $nama;
        private string $deskripsi;
        private string $jenis;


        public function __construct(string $gambar = "", string $nama ="", string $deskripsi="", string $jenis="")
        {
            $this->gambar = $gambar;
            $this->nama= $nama;
            $this->deskripsi = $deskripsi;
            $this->jenis = $jenis;
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

        public function getGambar()
        {
                return $this->gambar;
        }

        public function setGambar($gambar)
        {
                $this->gambar = $gambar;

                return $this;
        }

        public function getNama()
        {
                return $this->nama;
        }
 
        public function setNama($nama)
        {
                $this->nama = $nama;

                return $this;
        }

        public function getDeskripsi()
        {
                return $this->deskripsi;
        }

        public function setDeskripsi($deskripsi)
        {
                $this->deskripsi = $deskripsi;

                return $this;
        }
        public function getJenis()
        {
                return $this->jenis;
        }

        public function setJenis($jenis)
        {
                $this->jenis = $jenis;

                return $this;
        }


    }

}
