<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUlasan extends Model
{
    protected $table = 'ulasanbuku'; // Nama tabel di database
    protected $allowedFields = ['UlasanID', 'UserID', 'BukuID', 'Ulasan', 'Rating']; // Kolom yang dapat diisi
    protected $primaryKey = 'UlasanID';

    public function getAll()
    {
        return $this->findAll(); // Mengambil semua data rating
    }
}
