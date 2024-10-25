<?php

namespace App\Controllers;

use App\Models\model_daftar_buku;
use App\Models\model_kategori;

class Home extends BaseController
{
    public function __construct()
    {
        $this->model_daftar_buku = new model_daftar_buku();
        $this->model_kategori = new model_kategori();
    }
    public function beranda()
    {
        $status_login = session()->get('status_login');
        $username = session()->get('username');
        $semua_daftar_buku = $this->model_daftar_buku->semua_daftar_buku();
        $semua_kategori_buku = $this->model_kategori->semua_kategori_buku();

          // Cek apakah ada parameter pencarian
          $cari_buku = $this->request->getGet('cari_buku');
          if ($cari_buku) {
              $semua_daftar_buku = $this->model_daftar_buku->cari_buku($cari_buku);
          }
          
        $data=[
            'status_login' => $status_login,
            'username' => $username,
            'semua_kategori_buku' => $semua_kategori_buku,
            'semua_daftar_buku' => $semua_daftar_buku
        ];

        return view('display_beranda/home',$data);
    }
 
}
