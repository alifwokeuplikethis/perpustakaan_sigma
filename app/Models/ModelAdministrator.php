<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAdministrator extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk menyimpan data pengguna
    public function insert_user($username, $password) {
        // Hash password sebelum disimpan

        // Data yang akan dimasukkan ke database
        $data = array(
            'username' => $username,
            'password' => $hashed_password
        );

        // Menyimpan data ke tabel 'users'
        return $this->db->insert('user', $data);
    }

    public function cek_data($table, $where) {
        $query = $this->db->get_where($table, $where);
        return $query->num_rows() > 0; // True jika ada data, False jika tidak
    }
}
