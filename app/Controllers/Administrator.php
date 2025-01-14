<?php

namespace App\Controllers;

use App\Models\ModelAdministrator;

class Administrator extends BaseController
{
    protected $ModelAdministrator;

    public function __construct()
    {
        $this->ModelAdministrator = new ModelAdministrator(); // Muat model
    }
    
    public function login()
    {
        return view('administrator/login');
    }

    public function logon()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Ambil data user berdasarkan username
        $user = $this->ModelAdministrator->login_session($username);

        if (isset($user) && $user['UserKey'] == '1') {
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
                return redirect()->to(base_url('/perpus'));
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->to('/administrator/register');
            }
        }else{
            session()->setFlashdata('error', 'Tidak ada data yang cocok dengan user admin');
            return redirect()->to('/administrator/login');
        }
    }

    public function register_page()
    {
        return view('administrator/register');
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
            'UserKey' => '1',
            'Email'    => $email,
            'Password' => $hashedPassword,
            'NamaLengkap' => $namalengkap,
            'Alamat' => $alamat,
        ];

        if ($this->ModelAdministrator->cek_data($where)) {
            // $this->session->set_flashdata('error', '');
            // return redirect()->to('/index');
        } else {
            $this->ModelAdministrator->insert_user($data);
            session()->setFlashdata('berhasil', 'Berhasil Menambahkan User');
            return redirect()->to('/administrator/login');
        }
    }
}
