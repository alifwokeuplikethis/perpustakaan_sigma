<?php

namespace App\Controllers;

use App\Models\ModelUlasan;

class Ulasan extends BaseController
{

    public function __construct()
    {
        $this->ModelUlasan = new ModelUlasan(); // Muat model
    }
    
    public function ulasan(){  
        $bukuid = $this->request->getUri()->getSegment(2);
        $ulasan = $this->ModelUlasan->findAll();
        return view('ulasan/ulasan', ['bukuid' => $bukuid, 'ulasan' => $ulasan]);
    }

    public function add(){
        $rating = $this->request->getPost('rating');
        $ulasan = $this->request->getPost('ulasan');
        $bukuid = $this->request->getPost('bukuid'); 
        $userid = session()->get('user')['UserID'];

        $data = [
            'Rating' => $rating,
            'Ulasan' => $ulasan,
            'BukuID' => $bukuid,
            'UserID' => $userid
        ];
        log_message('error', 'BukuID: ' . $bukuid);
        if($this->ModelUlasan->insert($data)){
            return json_encode(['success' => true]);  
        } else{
            return json_encode(['success' => false]);
        }
    }
}
