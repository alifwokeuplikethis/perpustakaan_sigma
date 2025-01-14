<?php

namespace App\Controllers;

use App\Models\ModelBuku;
use App\Models\ModelKategori;
use App\Models\ModelKategoriRelasi;

class Buku extends BaseController
{

    public function __construct()
    {
        $this->ModelBuku = new ModelBuku(); // Muat model
        $this->ModelKategori = new ModelKategori(); // Muat model
        $this->ModelKategoriRelasi = new ModelKategoriRelasi(); // Muat model
    }
    
    public function data()
    {
        $data['buku'] = $this->ModelBuku->getBukuWithKategori(); 
        return view('buku/data', $data);
    }

    public function addpage(){
        $data['kategori'] = $this->ModelKategori->findAll();
        return view('buku/add', $data);
    }

    public function editpage($id = null){
        $buku = $this->ModelBuku->find($id);
        $kategori = $this->ModelKategori->findAll();
        $selectedkategori = $this->ModelBuku->selectKategori($id);
        $data = array(
            'data' => $buku,
            'kategori' => $kategori,
            'selected' => $selectedkategori
        );

        return view('buku/edit', $data);
    }


    public function edit()
    {
        $judul = $this->request->getPost('Judul');
        $penulis = $this->request->getPost('Penulis');
        $penerbit = $this->request->getPost('Penerbit');
        $tahunterbit = $this->request->getPost('TahunTerbit');
        $gambar = $this->request->getFile('Gambar');
        $bukuid = $this->request->getPost('bukuid');
        $Kategori = $this->request->getPost('Kategori');
    
        $buku = $this->ModelBuku->find($bukuid);
    
        // Data default untuk update (tanpa gambar)
        $newData = [
            'Judul' => $judul,
            'Penulis' => $penulis,
            'Penerbit' => $penerbit,
            'TahunTerbit' => $tahunterbit,
        ];
        
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // Jika gambar diupload, hapus gambar lama
            if (file_exists(WRITEPATH . '../public/' . ltrim($buku['gambar_path'], '/'))) {
                unlink(WRITEPATH . '../public/' . ltrim($buku['gambar_path'], '/'));
            }
    
            $fileName = $gambar->getRandomName();
            $gambar->move('Gambar', $fileName);
    
            // Tambahkan path gambar baru ke data update
            $newData['gambar_path'] = 'Gambar/' . $fileName;
        }
    
        // Lakukan update ke database
        if ($this->ModelBuku->update($bukuid, $newData)) {
            $datakategori = ['KategoriID' => $Kategori];
            $result = $this->ModelKategoriRelasi->updatekategori(['BukuID' => $bukuid], $datakategori);

            if ($result) {
                return redirect()->to('/buku/data')->with('success', 'Book updated successfully.');
            }
        }
    
        return redirect()->back()->with('error', 'Failed to update book.');
    }
    

    public function add(){

        $Gambar = $this->request->getFile('Gambar');
        $Judul = $this->request->getPost('Judul');
        $Penulis = $this->request->getPost('Penulis');
        $Penerbit = $this->request->getPost('Penerbit');
        $TahunTerbit = $this->request->getPost('TahunTerbit');
        $Kategori = $this->request->getPost('Kategori');
;
        if ($Gambar->isValid() && !$Gambar->hasMoved()) {
            // Simpan file ke folder `uploads`
            $fileName = $Gambar->getRandomName();
            $Gambar->move('Gambar', $fileName);

            // Data untuk disimpan ke database
            $data = [
                'gambar_path' => 'Gambar/' . $fileName,
                'Judul' => $Judul,
                'Penulis' => $Penulis,
                'Penerbit' => $Penerbit,
                'TahunTerbit' => $TahunTerbit,
            ];
            $this->ModelBuku->insert_user($data);

            $bukuID = $this->ModelBuku->insertID();
            $datakategori = [
                'KategoriID' => $Kategori,
                'BukuID' => $bukuID
            ];
            $this->ModelKategoriRelasi->insert($datakategori);

            return redirect()->to('/buku/data')->with('success', 'Berhasil menambahkan buku');
        }

        return redirect()->to('/buku/data')->with('error', 'Error menambahkan buku');
    }

    public function delete(){

        $id = $this->request->getPost('id'); // Ambil ID dari request
        $path = $this->request->getPost('path'); // Ambil ID dari request

        if ($this->ModelBuku->delete($id) && unlink(WRITEPATH . '../public/' . ltrim($path, '/'))) { // Hapus data berdasarkan ID
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }


    public function kategori(){
        $buku = $this->ModelKategori->findall();
        $data = ['buku' => $buku];
        return view('buku/kategori', $data);
    }


    public function addkategoripage(){
        // $kategori = $this->request->getPost('kategori');
        return view('buku/addkategori');
    }

    public function addkategori(){
        $kategori = $this->request->getPost('kategori');

        $data = ['NamaKategori' => $kategori];
        if($this->ModelKategori->insert($data)){
            return redirect()->to('/buku/kategori')->with('success', 'Berhasil menambahkan kategori');
        }
    }


}
