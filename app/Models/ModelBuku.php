<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBuku extends Model
{
    protected $table = 'buku'; // Nama tabel di database
    protected $allowedFields = ['BukuID', 'Judul', 'Penulis', 'Penerbit', 'TahunTerbit', 'Genre', 'gambar_path']; // Kolom yang dapat diisi
    protected $primaryKey = 'BukuID'; // Default primary key

    // Fungsi untuk memeriksa data berdasarkan kondisi
    public function insert_user($data)
    {
        return $this->insert($data); // Gunakan metode bawaan Model
    }

    public function getBukuWithKategori()
    {
        return $this->db->table('buku')
            ->select('buku.*, kategoribuku.NamaKategori')
            ->join('kategoribuku_relasi', 'kategoribuku_relasi.BukuID = buku.BukuID')
            ->join('kategoribuku', 'kategoribuku_relasi.KategoriID = kategoribuku.KategoriID')
            ->get()
            ->getResultArray();
    }

    public function selectKategori($id)
    {
        return $this->db->table('buku')
            ->select('kategoribuku_relasi.KategoriID')  // Ambil hanya KategoriID
            ->join('kategoribuku_relasi', 'kategoribuku_relasi.BukuID = buku.BukuID')
            ->where('buku.BukuID', $id) // Pastikan filter berdasarkan BukuID
            ->get()
            ->getRowArray(); // Gunakan getRowArray() untuk mendapatkan satu baris yang relevan
    }
    
    
}
