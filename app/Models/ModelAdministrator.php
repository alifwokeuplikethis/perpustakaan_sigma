<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdministrator extends Model
{
    protected $table = 'user'; // Nama tabel di database
    protected $allowedFields = ['UserID', 'UserKey', 'Email', 'NamaLengkap', 'Alamat', 'Username', 'Password']; // Kolom yang dapat diisi

    // Fungsi untuk memeriksa data berdasarkan kondisi
    public function cek_data($where)
    {
        return $this->where($where)->countAllResults() > 0; // True jika ada data, False jika tidak
    }

    // Fungsi untuk menyimpan data pengguna
    public function insert_user($data)
    {
        return $this->insert($data); // Gunakan metode bawaan Model
    }

    public function login_session($username)
    {
        return $this->where('Username', $username)->first();
    }
}
