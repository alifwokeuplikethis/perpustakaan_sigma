<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPeminjaman extends Model
{
    protected $table = 'peminjaman'; // Nama tabel di database
    protected $allowedFields = ['PeminjamanID', 'UserID', 'BukuID', 'TanggalPeminjaman', 'TanggalPengembalian', 'StatusPeminjaman']; // Kolom yang dapat diisi
    protected $primaryKey = 'PeminjamanID'; // Primary key column name

    // Fungsi untuk memeriksa data berdasarkan kondisi
    public function getData()
    {
        return $this->db->table('peminjaman')
            ->select('peminjaman.*, buku.Judul')
            ->join('buku', 'buku.BukuID = peminjaman.BukuID')
            ->get()
            ->getResultArray();
    }

    public function konfirmasi($data, $where)
    {
        return $this->db->table('peminjaman')->update($data, $where);
    }

    public function addkoleksi($data)
    {
        return $this->db->table('koleksipribadi')->insert($data);
    }
    public function isBukuInKoleksi($bukuId)
    {
        return $this->db->table('koleksipribadi')
                        ->where('BukuID', $bukuId)
                        ->countAllResults() > 0;
    }
    
    public function getAllKoleksi()
    {
        return $this->db->table('koleksipribadi')
                        ->join('buku', 'buku.BukuID = koleksipribadi.BukuID') // Join antara tabel 'buku' dan 'koleksipribadi'
                        ->join('kategoribuku_relasi', 'kategoribuku_relasi.BukuID = koleksipribadi.BukuID') // Join antara tabel 'buku' dan 'koleksipribadi'
                        ->join('kategoribuku', 'kategoribuku_relasi.KategoriID = kategoribuku.KategoriID') // Join antara tabel 'buku' dan 'koleksipribadi'
                        ->select('koleksipribadi.*, buku.Judul, buku.Penulis, buku.Penerbit, buku.TahunTerbit, buku.gambar_path, kategoribuku.NamaKategori, koleksipribadi.KoleksiID') // Pilih kolom yang diinginkan
                        ->get()
                        ->getResultArray();
    }
    
    
    public function deleteKoleksi($id)
    {
        return $this->db->table('koleksipribadi')
                        ->where('KoleksiID', $id)
                        ->delete();
    }
}
