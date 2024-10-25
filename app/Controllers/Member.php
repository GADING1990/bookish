<?php

namespace App\Controllers;
use App\Models\model_daftar_buku;
use App\Models\model_member;
use App\Models\modelpeminjaman;
use App\Models\modelpengembalian;
use App\Models\modelulasan;
use App\Models\modelkoleksibuku;
use App\Models\model_kategori;

class Member extends BaseController
{
    public function __construct()
    {
        $this->model_daftar_buku = new model_daftar_buku();
        $this->model_member = new model_member();
        $this->modelpeminjaman = new modelpeminjaman();
        $this->modelpengembalian = new modelpengembalian();
        $this->modelulasan = new modelulasan();
        $this->modelkoleksibuku = new modelkoleksibuku();
        $this->model_kategori = new model_kategori();
    }

  

    public function peminjaman_buku($buku_id)
    {
        $status_login = session()->get('status_login');
        $user_id = session()->get('user_id');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $tanggal_pinjam = date("Y-m-d");
        
        $dapatkan_daftar_buku = $this->model_daftar_buku->dapatkan_daftar_Buku($buku_id);
        $buku_id = $dapatkan_daftar_buku->buku_id;
        $kategori_id = $dapatkan_daftar_buku->kategori_id;
        $judul = $dapatkan_daftar_buku->judul;
        $penulis = $dapatkan_daftar_buku->penulis;
        $sinopsis = $dapatkan_daftar_buku->sinopsis;
        $penerbit = $dapatkan_daftar_buku->penerbit;
        $tahun_terbit = $dapatkan_daftar_buku->tahun_terbit;
        $cover = $dapatkan_daftar_buku->cover;
        $nama_kategori = $dapatkan_daftar_buku->nama_kategori;

        $semua_kategori_buku = $this->model_kategori->semua_kategori_buku();
        $semua_ulasan = $this->modelulasan->ulasanByBuku($buku_id);
        $avgRating = $this->modelulasan->avgRating($buku_id);

     
                $data = [
                    'buku_id'  => $buku_id,
                    'user_id'  => $user_id,
                    'kategori_id' => $kategori_id,
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'status_login' => $status_login,
                    'tanggal_pinjam' => $tanggal_pinjam,
                    'judul' => $judul,
                    'penulis' => $penulis,
                    'sinopsis' => $sinopsis,
                    'penerbit' => $penerbit,
                    'tahun_terbit' => $tahun_terbit,
                    'cover' => $cover,
                    'nama_kategori' => $nama_kategori,
                    'semua_kategori_buku' => $semua_kategori_buku,
                    'semua_ulasan' => $semua_ulasan,
                    'avgRating' => $avgRating,
                ];

                echo view('display_beranda/peminjaman_buku', $data);

          
    }

    public function proses_peminjaman_buku()
    {
        $request = \Config\Services::request();
        $user_id = $request->getVar('user_id');
        $buku_id = $request->getVar('buku_id');
        $tanggal_peminjaman = $request->getVar('tanggal_peminjaman');
        $tanggal_pengembalian = $request->getVar('tanggal_pengembalian');
        $total_pinjam = $request->getVar('total_pinjam');
        $status_peminjaman = 'di-pinjam';
        // Verifikasi apakah buku sudah dipinjam oleh anggota
        $buku_dipinjam = $this->modelpeminjaman->cek_buku_dipinjam($user_id, $buku_id);

        if ($buku_dipinjam) {
            // Jika buku sudah dipinjam, berikan pesan kesalahan atau ambil tindakan lain sesuai kebutuhan.
            session()->setFlashdata('error', 'Anda sudah meminjam buku ini sebelumnya.');
            return redirect()->to(base_url('/'));
        }
        $data = [
            'user_id' => $user_id,
            'buku_id' => $buku_id,
            'tanggal_peminjaman' => $tanggal_peminjaman,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'status_peminjaman' => $status_peminjaman,
            'total_pinjam' => $total_pinjam,
        ];
        $tambah_peminjaman = $this->modelpeminjaman->tambah_peminjaman($data);

        $dapatkan_daftar_buku = $this->model_daftar_buku->dapatkan_daftar_buku($buku_id);
        $stok_sekarang = $dapatkan_daftar_buku->stok;

        $stok_baru = $stok_sekarang - $total_pinjam;

        $ubah = $this->model_daftar_buku->edit_buku_dipinjam($buku_id, $stok_baru);
        session()->setFlashdata('success', 'Anda Berhasil Meminjam Buku');
        return redirect()->to(base_url('/'));
    }

    public function riwayat_peminjaman()
    {
        $status_login = session()->get('status_login');
        $user_id = session()->get('user_id');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $status_login = session()->get('status_login');
        
        $buku_dipinjam_by_member = $this->modelpeminjaman->buku_dipinjam_by_member($user_id);

        if ($status_login == TRUE) {
            $data = [
                'buku_dipinjam_by_member'  => $buku_dipinjam_by_member,
                'status_login'  => $status_login,
                'judul'  => 'Riwayat Peminjaman',
                'nama_lengkap'  => $nama_lengkap
            ];
            echo view('member/layout/head', $data);
            echo view('member/layout/nav');
            echo view('member/riwayat_peminjaman');
        } else {
            return redirect()->to(base_url('/login_member'));
        }
    }

    public function riwayat_pengembalian()
    {
        $status_login = session()->get('status_login');
        $user_id = session()->get('user_id');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $status_login = session()->get('status_login');
        $tanggal_pinjam = date("Y-m-d");
        
        $buku_dikembalikan_by_member = $this->modelpengembalian->buku_dikembalikan_by_member($user_id);

        if ($status_login == TRUE) {
            $data = [
                'buku_dikembalikan_by_member'  => $buku_dikembalikan_by_member,
                'status_login'  => $status_login,
                'judul'  => 'Riwayat Pengembalian',
                'nama_lengkap'  => $nama_lengkap
            ];
            echo view('member/layout/head', $data);
            echo view('member/layout/nav');
            echo view('member/riwayat_pengembalian');
        } else {
            return redirect()->to(base_url('/login_member'));
        }
    }

    public function koleksi_buku()
    {
        $status_login = session()->get('status_login');
        $user_id = session()->get('user_id');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $status_login = session()->get('status_login');
        $tanggal_pinjam = date("Y-m-d");
        $username = session()->get('username');
        
        $semua_koleksi_by_member = $this->modelkoleksibuku->semua_koleksi_by_member($user_id);

        if ($status_login == TRUE) {
            $data = [
                'semua_koleksi_by_member'  => $semua_koleksi_by_member,
                'status_login'  => $status_login,
                'judul'  => 'Koleksi Buku',
                'username'  => 'username',
                'nama_lengkap'  => $nama_lengkap
            ];

            echo view('display_beranda/koleksi_buku', $data);
        } else {
            return redirect()->to(base_url('/login_member'));
        }
    }

    public function proses_tambah_koleksi()
    {
        $request = \Config\Services::request();
        $user_id = $request->getVar('user_id');
        $buku_id = $request->getVar('buku_id');
        $kategori_id = $request->getVar('kategori_id');
        $cek_user_koleksi = $this->modelkoleksibuku->cek_user_koleksi($user_id, $buku_id);

        if($cek_user_koleksi) {
            session()->setFlashdata('info', 'Buku Sudah Ada Dikoleksi');
            return redirect()->back();
        } else {
            $data = [
                'user_id' => $user_id,
                'buku_id' => $buku_id,
                'kategori_id' => $kategori_id,
            ];
            $tambah = $this->modelkoleksibuku->tambah_koleksi($data);
            session()->setFlashdata('success', 'Anda Berhasil Menambahkan Koleksi Buku');
            return redirect()->back();
        }
       
    }

    public function proses_ulasan()
    {
        $request = \Config\Services::request();
        $user_id = $request->getVar('user_id');
        $buku_id = $request->getVar('buku_id');
        $ulasan = $request->getVar('ulasan');
        $rating = $request->getVar('rating');
        $tanggal_ulasan = date('Y-m-d');
        
        $cek_user_ulasan = $this->modelulasan->cek_user_ulasan($user_id, $buku_id);
        $semua_ulasan = $this->modelulasan->ulasanByBuku($buku_id);

        if($cek_user_ulasan) {
            session()->setFlashdata('info', 'Anda Sudah Memberikan Ulasan');
            return redirect()->back();
        } else {
            $data = [
                'user_id' => $user_id,
                'buku_id' => $buku_id,
                'ulasan' => $ulasan,
                'rating' => $rating,
                'tanggal_ulasan' => $tanggal_ulasan,
            ];
            $tambah = $this->modelulasan->tambah_ulasan($data);
            session()->setFlashdata('success', 'Anda Berhasil Memberikan Ulasan');
            return redirect()->back();
        }
    }
    public function hapus_koleksi_buku($buku_id)
    {
        $dapatkan_daftar_buku_koleksi = $this->modelkoleksibuku->dapatkan_daftar_buku_koleksi($buku_id);
        if (isset($dapatkan_daftar_buku_koleksi)) {
            $this->modelkoleksibuku->hapus_koleksi_buku($buku_id);
            session()->setFlashdata("success", "Berhasil Hapus Koleksi Buku");
            return redirect()->to(base_url('koleksi_buku'));
        } else {
            session()->setFlashdata("error", "Gagal Hapus Koleksi");
            return redirect()->to(base_url('koleksi_buku'));
        }
    }


    public function getBukuByKategori($kategori_id)
    {
        $status_login = session()->get('status_login');
        $user_id = session()->get('user_id');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        
        $getBukuByKategori = $this->model_daftar_buku->getBukuByKategori($kategori_id);

        if ($getBukuByKategori != null) {
            $nama_kategori = $getBukuByKategori[0]["nama_kategori"];
        } else {
            $nama_kategori = 'Tidak Tersedia';
        }
        $data = [
            'judul' => $nama_kategori,
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'status_login' => $status_login,
            'buku_kategori' => $getBukuByKategori,
        ];
        echo view('display_beranda/layout/head',$data);
        echo view('display_beranda/layout/nav');
        echo view('display_beranda/buku_kategori');
    }
    public function riwayat_pinjam()
    {
        $status_login = session()->get('status_login');
        $user_id = session()->get('user_id');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $status_login = session()->get('status_login');
        $username = session()->get('username');
        $buku_dipinjam_by_member = $this->modelpeminjaman->buku_dipinjam_by_member($user_id);

        if ($status_login == TRUE) {
            $data = [
                'buku_dipinjam_by_member'  => $buku_dipinjam_by_member,
                'status_login'  => $status_login,
                'judul'  => 'Riwayat Peminjaman',
                'username'  => 'username',
                'nama_lengkap'  => $nama_lengkap
            ];
           
            echo view('display_beranda/riwayat_peminjaman',$data);
        }
    }
    public function riwayat_kembali()
    {
        $status_login = session()->get('status_login');
        $user_id = session()->get('user_id');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $status_login = session()->get('status_login');
        $tanggal_pinjam = date("Y-m-d");
        
        $buku_dikembalikan_by_member = $this->modelpengembalian->buku_dikembalikan_by_member($user_id);

        if ($status_login == TRUE) {
            $data = [
                'buku_dikembalikan_by_member'  => $buku_dikembalikan_by_member,
                'status_login'  => $status_login,
                'judul'  => 'Riwayat Pengembalian',
                'nama_lengkap'  => $nama_lengkap
            ];
            echo view('display_beranda/riwayat_pengembalian',$data);
        }
    }
}
  
