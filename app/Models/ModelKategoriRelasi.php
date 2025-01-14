<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategoriRelasi extends Model
{
    protected $table = 'kategoribuku_relasi'; // Nama tabel di database
    protected $allowedFields = ['KategoriBukuID', 'BukuID', 'KategoriID']; // Kolom yang dapat diisi
    protected $primaryKey = 'KategoriBukuID'; // Default primary key

    // Fungsi untuk memeriksa data berdasarkan kondisi
    public function insert_user($data)
    {
        return $this->insert($data); // Gunakan metode bawaan Model
    }

    public function updatekategori($where, $data) {
        return $this->db->table('kategoribuku_relasi')->update($data, $where);
    }
    
}
