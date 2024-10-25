<?php

namespace App\Controllers;

use App\Models\modelpeminjaman;
use App\Models\modelpengembalian;
use App\Models\model_daftar_buku;
use App\Models\model_member;

class Petugas extends BaseController
{
    public function __construct()
    {
        $this->modelpeminjaman = new modelpeminjaman();
        $this->modelpengembalian = new modelpengembalian();
        $this->model_daftar_buku = new model_daftar_buku();
        $this->model_member = new model_member();
    }
    public function dashboard_petugas()
    {
        $nm_bulan = ["", "Januari", "Februari", "Maret", "April", "
        Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $total_peminjaman = $this->modelpeminjaman->total_peminjaman();
        $total_pengembalian = $this->modelpengembalian->total_pengembalian();
        $data=[
            'nm_bulan' => $nm_bulan,
            'total_peminjaman' => $total_peminjaman,
            'total_pengembalian' => $total_pengembalian,
        ];
        echo view('display_petugas/layout/head', $data);
        echo view('display_petugas/layout/nav');
        echo view('display_petugas/layout/side');
        echo view('display_petugas/dashboard_petugas');

        
    }
    public function halaman_daftar_peminjaman()
    {
        // data sesion wajib
        $status_login = session()->get('status_login');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $role = session()->get('role');

        $semua_peminjam = $this->modelpeminjaman->getAllStatusDipinjam();
      
                $data = [
                    'judul' => 'Daftar Peminjam',
                    'semua_peminjam' => $semua_peminjam,
                    // data sesion wajib
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'nama_lengkap' => $nama_lengkap,
                    'role' => $role,
                ];
                echo view('display_petugas/layout/head', $data);
                echo view('display_petugas/layout/nav');
                echo view('display_petugas/layout/side');
                echo view('display_petugas/halaman_daftar_peminjaman');
         
    }
    public function proses_edit_peminjaman()
    {
        $request = \Config\Services::request();
        $peminjaman_id = $this->request->getPost('peminjaman_id');
        $id_pengembalian = $this->request->getPost('id_pengembalian');
        $user_id = $this->request->getPost('user_id');
        $buku_id = $this->request->getPost('buku_id');
        $email = $this->request->getPost('email');
        $tanggal_pengembalian = $this->request->getPost('tanggal_pengembalian');
        $tanggal_hari_ini = $this->request->getPost('tanggal_hari_ini');
        $total_pinjam = $this->request->getPost('total_pinjam');
        $total_pengembalian = $this->request->getPost('total_pengembalian');
        $uang_dibayarkan = $this->request->getPost('uang_dibayarkan');
        $uang_kembalian = $this->request->getPost('uang_kembalian');
        $status_peminjaman = $this->request->getPost('status_peminjaman');            
        $total_keterlambatan = $this->request->getPost('total_keterlambatan');
        $total_denda = $this->request->getPost('total_denda');
        $sisa_total_pinjam = $total_pinjam - $total_pengembalian;


        if($sisa_total_pinjam != '0') {
            $data_peminjaman = [
                'total_pinjam' => $sisa_total_pinjam,
            ];
            $edit = $this->modelpeminjaman->edit_status_peminjaman($data_peminjaman, $user_id);
        } else {
            $data_peminjaman = [
                'status_peminjaman' => $status_peminjaman,
                'total_pinjam' => $sisa_total_pinjam,
            ];
            $edit = $this->modelpeminjaman->edit_status_peminjaman($data_peminjaman, $user_id);
        }
        
        $dapatkan_daftar_Buku = $this->model_daftar_buku->dapatkan_daftar_Buku($buku_id);
        $judul = $dapatkan_daftar_Buku->judul;
        $stok_lama = $dapatkan_daftar_Buku->stok;
        $dapatkan_member = $this->model_member->dapatkan_member($email)->getRow();
        $email = $dapatkan_member->email;
        $nama_lengkap = $dapatkan_member->nama_lengkap;

        $stok_baru = $total_pinjam + $stok_lama;

        $data_pengembalian = [
            'id_pengembalian' => $id_pengembalian,
            'user_id' => $user_id,
            'buku_id' => $buku_id,
            // 'peminjaman_id' => $peminjaman_id,
            'tanggal_pengembalian' => $tanggal_hari_ini,
            'hari_keterlambatan' => $total_keterlambatan,
            'total_pengembalian' => $total_pengembalian,
            'total_denda' => $total_denda,
            'uang_dibayarkan' => $uang_dibayarkan,
            'uang_kembalian' => $uang_kembalian,
        ];
        $data_struk = [
            'tanggal_pengembalian' => $tanggal_hari_ini,
            'judul' => $judul,
            'hari_keterlambatan' => $total_keterlambatan,
            'total_pengembalian' => $total_pengembalian,
            'total_denda' => $total_denda,
            'uang_dibayarkan' => $uang_dibayarkan,
            'uang_kembalian' => $uang_kembalian,
            'email' => $email,
            'nama_lengkap' => $nama_lengkap,
        ];

        $data_stok_baru = [
            'stok' => $stok_baru
        ];
        $tambah = $this->modelpengembalian->tambah_pengembalian($data_pengembalian);
        $simpan = $this->model_daftar_buku->ubah_stok_baru($data_stok_baru, $buku_id);
        session()->setFlashdata('success', 'Berhasil Edit Status Pengembalian !');
        // return redirect()->to(base_url('daftar_peminjam'));
        return view('display_petugas/cetak_struk_pengembalian', $data_struk);

    }
    public function cetak_peminjaman()
    {
        $status_peminjaman = $this->request->getPost('status_peminjaman');
        $cetak_peminjaman = $this->modelpeminjaman->cetak_peminjaman($status_peminjaman);
        $data = [
            'judul' => 'Cetak Peminjaman',
            'status_peminjaman' => $status_peminjaman,
            'data_cetak' => $cetak_peminjaman,
        ];

        return view('display_petugas/cetak_peminjaman', $data);
    }

    public function cetak_pengembalian()
    {
      
        $cetak_pengembalian = $this->modelpengembalian->cetak_pengembalian();
        $data = [
            'judul' => 'Cetak Peminjaman',
            'data_cetak' => $cetak_pengembalian,
        ];
}
public function halaman_daftar_pengembalian()
{
    // data sesion wajib
    $status_login = session()->get('status_login');
    $nama_lengkap = session()->get('nama_lengkap');
    $email = session()->get('email');
    $role = session()->get('role');

    $semua_pengembali = $this->modelpengembalian->semua_dikembalikan();
    $data = [
        'semua_pengembali' => $semua_pengembali,
    ];
    echo view('display_petugas/layout/head', $data);
    echo view('display_petugas/layout/nav');
    echo view('display_petugas/layout/side');
    echo view('display_petugas/halaman_daftar_pengembalian');

}
            
          
    }


