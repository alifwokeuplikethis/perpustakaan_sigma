<?php

namespace App\Controllers;

use App\Models\ModelPetugas;

class Petugas extends BaseController
{

    public function __construct()
    {
        $this->ModelPetugas = new ModelPetugas(); // Muat model
    }

    public function login()
    {
        return view('petugas/login');
    }

    public function logon()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Ambil data user berdasarkan username
        $user = $this->ModelPetugas->login_session($username);

        if (isset($user) && $user['UserKey'] == '2') {
            // Verifikasi password
            if (password_verify($password, $user['Password'])) {
                // Set session
                session()->setFlashdata('berhasil', 'Selamat datang');
                session()->set('user', [
                    'Username' => $user['Username'],
                    'UserKey' => $user['UserKey'],
                    'NamaLengkap' => $user['NamaLengkap'],
                    'Email' => $user['Email'],
                    'UserID' => $user['UserID'],
                    'Alamat' => $user['Alamat']
                ]);
                return redirect()->to('/perpus');
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->to('/petugas/login');
            }
        }else{
            session()->setFlashdata('error', 'Tidak ada data yang cocok dengan user petugas');
            return redirect()->to('/petugas/login');
        }
    }


    public function register_page()
    {
        if (session()->get('user')['UserKey'] != '1') {
            session()->destroy();
            return redirect()->to('/')->with('error', 'Anda bukan admin.');
        }
        
        return view('petugas/register');
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
            'UserKey' => '2',
            'Email'    => $email,
            'Password' => $hashedPassword,
            'NamaLengkap' => $namalengkap,
            'Alamat' => $alamat,
        ];

        if ($this->ModelPetugas->cek_data($where)) {
            session()->setFlashdata('error', 'Username sudah ada, mohon gunakan nama lain');
            return redirect()->to('/petugas/register');
        } else {
            $this->ModelPetugas->insert_user($data);
            session()->setFlashdata('berhasil', 'Berhasil Menambahkan User');
            return redirect()->to('/petugas/login');
        }
    }
}
