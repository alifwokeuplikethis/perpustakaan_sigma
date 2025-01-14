<?php

namespace App\Controllers;

use App\Models\ModelPeminjam;

class Peminjam extends BaseController
{
    protected $ModelPeminjam;

    public function __construct()
    {
        $this->ModelPeminjam = new ModelPeminjam(); // Muat model
    }
    
    public function login()
    {
        return view('peminjam/login');
    }

    public function logon()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Ambil data user berdasarkan username
        $user = $this->ModelPeminjam->login_session($username);

        if (isset($user) && $user['UserKey'] == '3') {
            // Verifikasi password
            if (password_verify($password, $user['Password'])) {
                // Set session
                session()->setFlashdata('berhasil', 'Selamat datang');
                session()->set('user', [
                    'Username' => $user['Username'],
                    'UserKey' => $user['UserKey'],
                    'UserID' => $user['UserID'],
                    'NamaLengkap' => $user['NamaLengkap'],
                    'Email' => $user['Email'],
                    'Alamat' => $user['Alamat']
                ]);
                return redirect()->to('/perpus');
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->to('/peminjam/login');
            }
        }else{
            session()->setFlashdata('error', 'Tidak ada data yang cocok dengan user peminjam');
            return redirect()->to('/peminjam/login');
        }
    }

    public function register_page()
    {
        return view('peminjam/register');
    }
    public function register()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $email = $this->request->getPost('email');
        $namalengkap = $this->request->getPost('namalengkap');
        $alamat = $this->request->getPost('alamat');

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $where = ['username' => $username];
        
        $data = [
            'Username' => $username,
            'UserKey' => '3',
            'Email'    => $email,
            'Password' => $hashedPassword,
            'NamaLengkap' => $namalengkap,
            'Alamat' => $alamat,
        ];

        if ($this->ModelPeminjam->cek_data($where)) {
            session()->setFlashdata('error', 'Username sudah ada, mohon gunakan nama lain');
            return redirect()->to('/peminjam/register');
        } else {
            $this->ModelPeminjam->insert_user($data);
            session()->setFlashdata('berhasil', 'Berhasil Menambahkan User');
            return redirect()->to('/peminjam/login');
        }
    }
}
