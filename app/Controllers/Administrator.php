<?php

namespace App\Controllers;

use CodeIgniter\Encryption\Password;
use App\Models\ModelAdministrator;

class Administrator extends BaseController
{
    public function __construct() {
        $this->ModelAdministrator = new ModelAdministrator(); // Muat model di dalam konstruktor
    }
    
    public function login()
    {
        return view('administrator/login');
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

        $where = array('username' => $username);

        if ($this->ModelAdministrator->cek_data('user', $where)) {
            return view('administrator/login');
        } else {
            return view('index');
        }
    }
}
