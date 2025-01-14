<?php

namespace App\Controllers;

use App\Models\ModelBuku;
use App\Models\ModelPeminjaman;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelBuku = new ModelBuku();
        $this->ModelPeminjaman = new ModelPeminjaman();
    }

    public function index()
    {
        return view('LandingPage');
    }
    public function perpus()
    {
        
        $data['buku'] = $this->ModelBuku->getBukuWithKategori(); 

        foreach ($data['buku'] as &$row) {
            $row['inKoleksi'] = $this->ModelPeminjaman->isBukuInKoleksi($row['BukuID']);
        }
        if (!session()->get('user')) {
            session()->destroy();
            return redirect()->to('/')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
        return view('index', $data);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
