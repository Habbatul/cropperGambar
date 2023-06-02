<?php

namespace Service {

    use Entity\Jasa;
    use Repository\JasaRepository;

    interface JasaService
    {

        function ShowJasa();

        function addJasa(string $pemilik, string $status, string $resi, string $nama_laptop, string $tanggal): void;

        function removeJasa(int $number): void;

        function changeJasa(int $id, string $pemilik, string $status, string $resi, string $nama_laptop, string $tanggal): void;
        
    }

    class JasaServiceImpl implements JasaService
    {
        //nerapin depedency injection sehingga objek diberikan dari luar kelas
        private JasaRepository $jasaRepository;

        public function __construct(JasaRepository $jasaRepository)
        {
            $this->jasaRepository = $jasaRepository;
        }

        function ShowJasa()
        {
            
            $jasa = $this->jasaRepository->findAll();


            $rows = array_map(function($value) {
                return [
                    'id' => $value->getId(),
                    'pemilik' => $value->getPemilik(),
                    'status' => $value->getStatus(),
                    'resi' => $value->getResi(),
                    'nama_laptop' => $value->getNama_laptop(),
                    'tanggal' => $value->getTanggal(),
                ];
            }, $jasa);

            $data = array('data' => $rows);
            return json_encode($data);
        }

        function addJasa(string $pemilik, string $status, string $resi, string $nama_laptop, string $tanggal): void
        {
            $jasa = new Jasa($pemilik, $status, $resi, $nama_laptop, $tanggal);
            $this->jasaRepository->save($jasa);
            echo "<script>alert('SUKSES MENAMBAH Jasa');window.location.href='jasa';</script>";
        }

        function changeJasa(int $id, string $pemilik, string $status, string $resi, string $nama_laptop, string $tanggal): void
        {
            $this->jasaRepository->updateByID($id, $pemilik, $status, $resi, $nama_laptop, $tanggal);
            echo "<script>alert('SUKSES MENGUBAH Jasa');window.location.href='jasa';</script>";
        }

        function removeJasa(int $number): void
        {
            if ($this->jasaRepository->remove($number)) {
                echo "<script>alert('SUKSES MENGHAPUS Jasa');window.location.href='jasa';</script>";
            } else {
                echo "<script>alert('GAGAL MENGHAPUS Jasa');window.location.href='jasa';</script>";
            }
        }
        
    }

}
