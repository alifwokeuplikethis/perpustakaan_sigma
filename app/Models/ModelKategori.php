<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table = 'kategoribuku'; // Nama tabel di database
    protected $allowedFields = ['KategoriID', 'NamaKategori']; // Kolom yang dapat diisi
    protected $primaryKey = 'KategoriID'; // Default primary key

    // Fungsi untuk memeriksa data berdasarkan kondisi
    public function insert_user($data)
    {
        return $this->insert($data); // Gunakan metode bawaan Model
    }
}
