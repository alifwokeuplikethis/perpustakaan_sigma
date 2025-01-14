<?php

namespace App\Controllers;

use App\Models\ModelPeminjaman;

class Peminjaman extends BaseController
{

    public function __construct()
    {
        $this->ModelPeminjaman = new ModelPeminjaman(); // Muat model
    }

    public function meminjam($id = null)
    {

        return view('peminjaman/meminjam', ['bukuid' => $id]);
    }
    

    public function minjam(){
        $dikembalikan = $this->request->getPost('dikembalikan');
        $bukuid = $this->request->getPost('bukuid');
        $userid = $this->request->getPost('userid');
        $tanggalmeminjam = date('Y-m-d');

        $data = [
            'BukuID' => $bukuid,
            'UserID' => $userid,
            'TanggalPeminjaman' => $tanggalmeminjam,
            'TanggalPengembalian' => $dikembalikan,
            'StatusPeminjaman' => 'Menunggu konfirmasi petugas'
        ];
        if($this->ModelPeminjaman->insert($data)){
            return redirect()->to('/perpus')->with('success', 'Book updated successfully.');
        }
    }

    public function detail(){
        $peminjaman = $this->ModelPeminjaman->getData();
        return view('peminjaman/detail', ['peminjaman' => $peminjaman]);
    }

    public function konfirmasi(){
        $idpeminjaman = $this->request->getPost('idpeminjaman'); // ID peminjaman
        $data = ['StatusPeminjaman' => 'Disetujui'];
        if($this->ModelPeminjaman->konfirmasi($data, ['PeminjamanID' => $idpeminjaman])){
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function delete(){
        $idpeminjaman = $this->request->getPost('idpeminjaman'); // ID peminjaman
        if($this->ModelPeminjaman->delete($idpeminjaman)){
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function addkoleksi(){
        $idbuku = $this->request->getPost('idbuku'); // ID peminjaman
        $iduser = session()->get('user')['UserID'];
        $data = [
            'UserID' => $iduser,
            'BukuID' => $idbuku
        ];
        if($this->ModelPeminjaman->addkoleksi($data)){
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }


    public function koleksi(){
        $data['buku'] = $this->ModelPeminjaman->getAllKoleksi();
        return view('koleksi/data', $data);
    }

    public function deletekoleksi(){
        $idkoleksi = $this->request->getPost('idkoleksi'); // ID peminjaman
        if($this->ModelPeminjaman->deletekoleksi($idkoleksi)){
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

}
