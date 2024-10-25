<?php

namespace App\Controllers;

use App\Models\model_kategori;
use App\Models\model_sub_kategori;
use App\Models\model_daftar_buku;
use App\Models\model_admin;
use App\Models\model_petugas;
use App\Models\model_member;





class Admin extends BaseController
{
    public function __construct()
    {
        $this->model_kategori = new model_kategori();
        $this->model_sub_kategori = new model_sub_kategori();
        $this->model_daftar_buku = new model_daftar_buku();
        $this->model_admin = new model_admin();
        $this->model_petugas = new model_petugas();
        $this->model_member = new model_member();
    }
    public function halaman_user()
    {
        // data sesion wajib
        $status_login = session()->get('status_login');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $role = session()->get('role');
        $semua_member = $this->model_member->semua_member();

                $data = [
                    'judul' => 'Daftar Admin',
                    // data sesion wajib
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'semua_member' => $semua_member,
                    'nama_lengkap' => $nama_lengkap,
                    'role' => $role,
                ];
                echo view('display_admin/layout/head', $data);
                echo view('display_admin/layout/side');
                echo view('display_admin/layout/nav');
                echo view('display_admin/halaman_user');
               
          
    }
      //bagian proses edit user
 public function proses_edit_user() 
 {
     $request = \Config\Services::request();
     $user_id = $this->request->getPost('user_id');
     $nama_lengkap = $this->request->getPost('nama_lengkap');
     $alamat = $this->request->getPost('alamat');
     $email = $this->request->getPost('email');
     $username = $this->request->getPost('username');
     $password = $this->request->getPost('password');

     $data = [
         'nama_lengkap' => $nama_lengkap,
         'email' => $email,
         'alamat' => $alamat,
         'user_id' => $user_id,
         'username' => $username,
         'password' => $password,
     ];
     $this->model_akun->edit_user($data, $user_id);
     session()->setFlashdata("success", "Berhasil Edit user");
     return redirect()->to(base_url('halaman_user'));
 }
 
 public function hapus_user($user_id)
 {
     $dapatkan_member = $this->model_member->dapatkan_member($user_id);
     if (isset($dapatkan_member)) {
         $this->model_member->hapus_user($user_id);
         session()->setFlashdata("success", "Berhasil Hapus user");
         return redirect()->to(base_url('halaman_user'));
     } else {
         session()->setFlashdata("error", "Gagal Hapus user");
         return redirect()->to(base_url('halaman_user'));
     }
 }


    public function dashboard_admin()
    {
        $status_login = session()->get('status_login');
        $nama_lengkap = session()->get('nama_lengkap');
        $email = session()->get('email');
        $role = session()->get('role');

        $total_buku = $this->model_daftar_buku->total_buku();
        $total_kategori = $this->model_kategori->total_kategori();
        $total_sub_kategori = $this->model_sub_kategori->total_sub_kategori();
        $total_admin = $this->model_petugas->total_admin();
        $total_petugas = $this->model_petugas->total_petugas();
        $total_member = $this->model_member->total_member();

  
                $data = [
                    'judul' => 'dashboard Admin',
                    'total_buku' => $total_buku,
                    'total_kategori' => $total_kategori,
                    'total_sub_kategori' => $total_sub_kategori,
                    'total_admin' => $total_admin,
                    'total_petugas' => $total_petugas,
                    'total_member' => $total_member,
                    // data sesion wajib
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'nama_lengkap' => $nama_lengkap,
                    'role' => $role,
                ];
        echo view('display_admin/layout/head');
        echo view('display_admin/layout/nav');
        echo view('display_admin/layout/side');
        echo view('display_admin/dashboard_admin', $data);

        
    }

  //halaman Admin
  public function halaman_admin()
  {
      $semua_daftar_admin = $this->model_admin->semua_daftar_admin();
      $kode_admin = $this->model_petugas->kode_admin();

      $data = [
          'judul' => 'halaman admin',
          'semua_daftar_admin' => $semua_daftar_admin,
          'kode_admin' => $kode_admin,     
      ];
      echo view('display_admin/layout/head',$data);
      echo view('display_admin/layout/nav');
      echo view('display_admin/layout/side');
      echo view('display_admin/halaman_admin');
  }
    //bagian proses tambah Admin
 public function proses_tambah_Admin()
 {
    
     $email = $this->request->getPost('email');
     $password = $this->request->getPost('password');
     $nama_lengkap = $this->request->getPost('nama_lengkap');
     $alamat = $this->request->getPost('alamat');    
     $no_tlp = $this->request->getPost('no_tlp');    
     $role = $this->request->getPost('role');    
     $id_role = $this->request->getPost('id_role');    
     $data =[
       
         "email"=>$email,
         "password"=>$password,
         "nama_lengkap"=>$nama_lengkap,
         "alamat"=>$alamat,
         "no_tlp"=>$no_tlp,
         "role"=>$role,
         "id_role"=>$id_role,
     ];
     $this->model_admin->tambah_admin($data);
     return redirect()->to(base_url('halaman_admin'));

 }
  //bagian proses edit Admin
 public function proses_edit_admin() 
  {
      $request = \Config\Services::request();
      $id_role = $this->request->getPost('id_role');
      $nama_lengkap = $this->request->getPost('nama_lengkap');
      $alamat = $this->request->getPost('alamat');
      $email = $this->request->getPost('email');
      $no_tlp = $this->request->getPost('no_tlp');
      $id_role = $this->request->getPost('id_role');
      $password = $this->request->getPost('password');

      $data = [
          'nama_lengkap' => $nama_lengkap,
          'email' => $email,
          'alamat' => $alamat,
          'id_role' => $id_role,
          'no_tlp' => $no_tlp,
          'password' => $password,
      ];
      $this->model_admin->edit_admin($data, $id_role);
      session()->setFlashdata("success", "Berhasil Edit Admin");
      return redirect()->to(base_url('halaman_admin'));
  }
  
  public function hapus_admin($id_role)
  {
      $dapatkan_admin = $this->model_admin->dapatkan_admin($id_role);
      if (isset($dapatkan_admin)) {
          $this->model_admin->hapus_admin($id_role);
          session()->setFlashdata("success", "Berhasil Hapus Admin");
          return redirect()->to(base_url('halaman_admin'));
      } else {
          session()->setFlashdata("error", "Gagal Hapus Admin");
          return redirect()->to(base_url('daftar_admin'));
      }
  }

    //halaman ketegori buku
    public function halaman_kategoribuku()
    {
        $semua_kategori_buku = $this->model_kategori->semua_kategori_buku();
        $kode_kategori = $this->model_kategori->kode_kategori();

        $data = [
            'judul' => 'Kategori Buku',
            'semua_kategori_buku' => $semua_kategori_buku,
            'kode_kategori' => $kode_kategori,
        ];
        echo view('display_admin/layout/head',$data);
        echo view('display_admin/layout/nav');
        echo view('display_admin/layout/side');
        echo view('display_admin/halaman_kategoribuku');
    }
 
     //bagian proses tambah  kategori 
    public function proses_tambah_kategori_buku()
    {
        $nama_kategori = $this->request->getPost('nama_kategori');
        $kategori_id  = $this->request->getPost('kategori_id');
        $data = [
            'nama_kategori' => $nama_kategori,
            'kategori_id' => $kategori_id
        ];
        $simpan = $this->model_kategori->tambah_kategori_buku($data);
        session()->setFlashdata('success', 'Berhasil Tambah Kategori Buku !');
        return redirect()->to(base_url('/halaman_kategoribuku'));
    }

     //bagian proses tambah  kategori 
    public function proses_edit_kategori_buku()
    {
        $kategori_id  = $this->request->getPost('kategori_id');
        $nama_kategori = $this->request->getPost('nama_kategori');
        $data = [
            'kategori_id' => $kategori_id,
            'nama_kategori' => $nama_kategori,

        ];
        $simpan = $this->model_kategori->edit_kategori_buku($data, $kategori_id );
        session()->setFlashdata('success', 'Berhasil Edit Kategori Buku !');
        return redirect()->to(base_url('/halaman_kategoribuku'));
    }
    //bagian hapus kategori
    public function hapus_kategori_buku($kategori_id)
    {
        $dapatkanKategoriBuku = $this->model_kategori->dapatkanKategoriBuku($kategori_id)->getRow();
        
        if (isset($dapatkanKategoriBuku)) {
            $this->model_kategori->hapus_kategori_buku($kategori_id);
            session()->setFlashdata("success", "Berhasil Hapus Kategori Buku");
            return redirect()->to(base_url('halaman_kategoribuku'));
        } else {
            session()->setFlashdata("error", "Gagal Hapus Kategori Buku");
            return redirect()->to(base_url('halaman_kategoribuku'));
        }
    }

    //halaman sub ketegori buku
    public function halaman_sub_kategori()
    {
        $semua_sub_kategori = $this->model_sub_kategori->semua_sub_kategori();
        $semua_kategori_buku = $this->model_kategori->semua_kategori_buku();
        $kode_sub_kategori = $this->model_sub_kategori->kode_sub_kategori();
        $data = [
            'judul' => 'sub kategori',
            'semua_sub_kategori' => $semua_sub_kategori,
            'semua_kategori_buku' => $semua_kategori_buku,
            'kode_sub_kategori' => $kode_sub_kategori,
        ];
        echo view('display_admin/layout/head',$data);
        echo view('display_admin/layout/nav');
        echo view('display_admin/layout/side');
        echo view('display_admin/halaman_sub_kategori');
    }

    //bagian proses tambah sub kategori 
    public function proses_tambah_sub_kategori()
    {
        $nama_sub_kategori = $this->request->getPost('nama_sub_kategori');
        $kategori_id = $this->request->getPost('kategori_id');
        $id_sub_kategori = $this->request->getPost('id_sub_kategori');
        $data = [
            'kategori_id' => $kategori_id,
            'id_sub_kategori' => $id_sub_kategori,
            'nama_sub_kategori' => $nama_sub_kategori,

        ];
        $simpan = $this->model_sub_kategori->tambah_sub_kategori($data);
        session()->setFlashdata('success', 'Berhasil Sub Kategori Buku !');
        return redirect()->to(base_url('/halaman_sub_kategori'));
    }

     //bagian proses edit sub kategori 
    public function proses_edit_sub_kategori()
    {
        $id_sub_kategori = $this->request->getPost('id_sub_kategori');
        $kategori_id = $this->request->getPost('kategori_id');
        $nama_sub_kategori = $this->request->getPost('nama_sub_kategori');
        $data = [
            'id_sub_kategori' => $id_sub_kategori,
            'kategori_id' => $kategori_id,
            'nama_sub_kategori' => $nama_sub_kategori,        
        ];
        $simpan = $this->model_sub_kategori->edit_sub_kategori($data, $id_sub_kategori);
        session()->setFlashdata('success', 'Berhasil Edit Sub Kategori !');
        return redirect()->to(base_url('/halaman_sub_kategori'));
    }

    //
    public function loadSubKategori () {
        $kategori_id = $this->request->getPost('kategori_id');

        $getSubByKategori = $this->model_sub_kategori->getSubByKategori($kategori_id);
        $data = [
            'semua_sub_kategori' => $getSubByKategori,
        ];
        return view('display_admin/loadSubKategori', $data);
       
    }

    //bagian hapus sub kategori
    public function hapus_sub_kategori($id_sub_kategori)
    {
        $dapatkan_sub_kategori = $this->model_sub_kategori->dapatkan_sub_kategori($id_sub_kategori);
        if (isset($dapatkan_sub_kategori)) {
            $this->model_sub_kategori->hapus_sub_kategori($id_sub_kategori);
            session()->setFlashdata("success", "Berhasil Hapus Sub Kategori");
            return redirect()->to(base_url('halaman_sub_kategori'));
        } else {
            session()->setFlashdata("error", "Gagal Hapus Sub Kategori");
            return redirect()->to(base_url('halaman_sub_kategori/'+id_sub_kategori));
        }
    }

    //halaman daftar buku
    public function halaman_daftar_buku()
    {
        $semua_daftar_buku = $this->model_daftar_buku->semua_daftar_buku();
        $semua_kategori_buku = $this->model_kategori->semua_kategori_buku();
        $semua_sub_kategori = $this->model_sub_kategori->semua_sub_kategori();
        
        $data = [
            'judul' => 'sub kategori',
            'semua_daftar_buku' => $semua_daftar_buku,
            'semua_sub_kategori' => $semua_sub_kategori,
            'semua_kategori_buku' => $semua_kategori_buku,
        ];
        echo view('display_admin/layout/head',$data);
        echo view('display_admin/layout/nav');
        echo view('display_admin/layout/side');
        echo view('display_admin/halaman_daftar_buku');
    }
    //bagian proses tambah daftar buku
    public function proses_tambah_buku()
    {
        $request = \Config\Services::request();
        $judul = $this->request->getPost('judul');
        $buku_id = $this->request->getPost('buku_id');
        $kategori_id = $this->request->getPost('kategori_id');
        $id_sub_kategori = $this->request->getPost('id_sub_kategori');
        $penulis = $this->request->getPost('penulis');
        $sinopsis = $this->request->getPost('sinopsis');
        $penerbit = $this->request->getPost('penerbit');
        $tahun_terbit = $this->request->getPost('tahun_terbit');
        $stok = $this->request->getPost('stok');
        $cover = $request->getFile('cover');
    
        $kategori_id = ($kategori_id !== null) ? $kategori_id : 'null';
        $id_sub_kategori = ($id_sub_kategori !== null) ? $id_sub_kategori : 'null';

        $direktori_foto = 'buku';
        $fileName = $buku_id . '_' . $judul . '.png';
    
        $data = [
            'judul' => $judul,
            'buku_id' => $buku_id,
            'kategori_id' => $kategori_id,
            'id_sub_kategori' => $id_sub_kategori,
            'penulis' => $penulis,
            'sinopsis' => $sinopsis,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'stok' => $stok,
            'cover' => $fileName,
        ];
    
        $this->model_daftar_buku->tambah_daftar_buku($data);
    
        $cover->move($direktori_foto, $fileName);
        session()->setFlashdata('success', 'Data Berhasil Ditambah');
        return redirect()->to(base_url('halaman_daftar_buku'));
    }

// BAGIAN PROSES EDIT DAFTAR BUKU
    public function proses_edit_buku()
    {
        $request = \Config\Services::request();
        $judul = $this->request->getPost('judul');
        $buku_id = $this->request->getPost('buku_id');
        $kategori_id = $this->request->getPost('kategori_id');
        $id_sub_kategori = $this->request->getPost('id_sub_kategori');
        $penulis = $this->request->getPost('penulis');
        $stok = $this->request->getPost('stok');
        $penerbit = $this->request->getPost('penerbit');
        $tahun_terbit = $this->request->getPost('tahun_terbit');
        $cover = $request->getFile('cover');

        $direktori_foto = 'buku';
        $fileName = $judul . '_' . time() . '.png';
    
             // Jika sampul_buku tidak null dan valid, maka proses
             if ($cover && $cover->isValid()) {
                $buku = $this->model_daftar_buku->dapatkan_daftar_Buku($buku_id);
                // dd($buku);
                $sampul_lama = $buku->cover;
        
                // Hapus file lama jika ada
                if ($sampul_lama && file_exists($direktori_foto . '/' . $sampul_lama)) {
                    unlink($direktori_foto . '/' . $sampul_lama);
                }
            // Update data buku
            $data = [
                'judul' => $judul,
                'buku_id ' => $buku_id ,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'stok' => $stok,
                'cover' => $fileName,
            ];
    
            $simpan = $this->model_daftar_buku->edit_daftar_buku($data, $buku_id);
    
            // Pindahkan file sampul_buku
            $cover->move($direktori_foto, $fileName);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
            return redirect()->to(base_url('halaman_daftar_buku'));

        } else {
            // Jika sampul buku nya null maka update tanpa sampul
             $data = [
                'judul' => $judul,
                'buku_id' => $buku_id,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'stok' => $stok,
                'tahun_terbit' => $tahun_terbit,
            ];
    
            $simpan = $this->model_daftar_buku->edit_daftar_buku($data, $buku_id);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
            return redirect()->to(base_url('halaman_daftar_buku'));
        }    
    }
        public function proses_edit_kategori_sub_buku()
        {
            $request = \Config\Services::request();
            $buku_id = $this->request->getPost('buku_id');
            $kategori_id = $this->request->getPost('kategori_id');
            $id_sub_kategori = $this->request->getPost('id_sub_kategori');
            
            // Update data buku
            $data = [
                'kategori_id' => $kategori_id,
                'id_sub_kategori' => $id_sub_kategori,
            ];

            $simpan = $this->model_daftar_buku->edit_daftar_buku($data, $buku_id);

            session()->setFlashdata('success', 'Data Berhasil Diubah');
            return redirect()->to(base_url('halaman_daftar_buku'));
        }

      //bagian hapus daftar buku
      public function hapus_daftar_buku($buku_id)
      {
          $dapatkan_daftar_Buku = $this->model_daftar_buku->dapatkan_daftar_Buku($buku_id);
          $direktori_foto = 'buku';
          if (isset($dapatkan_daftar_Buku)) {

             // Hapus file sampul_buku jika ada
             if ($dapatkan_daftar_Buku->cover && file_exists($direktori_foto . '/' . $dapatkan_daftar_Buku->cover)) {
                unlink($direktori_foto . '/' . $dapatkan_daftar_Buku->cover);
            }
              $this->model_daftar_buku->hapus_daftar_buku($buku_id);
              session()->setFlashdata("success", "Berhasil Hapus Daftar Buku");
              return redirect()->to(base_url('halaman_daftar_buku'));
          } else {
              session()->setFlashdata("error", "Gagal Hapus Daftar Buku");
              return redirect()->to(base_url('halaman_daftar_buku'));
          }
      }
  
      public function halaman_petugas()
      {
          // data sesion wajib
          $status_login = session()->get('status_login');
          $nama_lengkap = session()->get('nama_lengkap');
          $email = session()->get('email');
          $id_role = session()->get('id_role');
          $semua_petugas = $this->model_petugas->semua_petugas();
          $kode_petugas = $this->model_petugas->kode_petugas();
  
         
                  $data = [
                      'judul' => 'Daftar Admin',
                      // data sesion wajib
                      'nama_lengkap' => $nama_lengkap,
                      'email' => $email,
                      'kode_petugas' => $kode_petugas,
                      'semua_petugas' => $semua_petugas,
                      'nama_lengkap' => $nama_lengkap,
                      'id_role' => $id_role,
                  ];
                  echo view('display_admin/layout/head', $data);
                  echo view('display_admin/layout/side');
                  echo view('display_admin/layout/nav');
                  echo view('display_admin/halaman_petugas');
                
            
      }
  
      public function proses_tambah_petugas() 
      {
          $request = \Config\Services::request();
          $id_role = $this->request->getPost('id_role');
          $nama_lengkap = $this->request->getPost('nama_lengkap');
          $alamat = $this->request->getPost('alamat');
          $email = $this->request->getPost('email');
          $password = $this->request->getPost('password');
          $no_tlp = $this->request->getPost('no_tlp');
          $role = $this->request->getPost('role');
  
          $data = [
              'id_role' => $id_role,
              'nama_lengkap' => $nama_lengkap,
              'email' => $email,
              'alamat' => $alamat,
              'password' => $password,
              'role' => $role,
              'no_tlp' => $no_tlp,
          ];
          $this->model_petugas->tambah_petugas($data);
          session()->setFlashdata("success", "Berhasil Tambah Petugas");
          return redirect()->to(base_url('halaman_petugas'));
      }
      public function proses_edit_petugas() 
      {
          $request = \Config\Services::request();
          $id_role = $this->request->getPost('id_role');
          $nama_lengkap = $this->request->getPost('nama_lengkap');
          $alamat = $this->request->getPost('alamat');
          $email = $this->request->getPost('email');
          $no_tlp = $this->request->getPost('no_tlp');
          $role = $this->request->getPost('role');
          $password = $this->request->getPost('password');
  
          $data = [
              'nama_lengkap' => $nama_lengkap,
              'email' => $email,
              'alamat' => $alamat,
              'id_role' => $id_role,
              'no_tlp' => $no_tlp,
              'password' => $password,
          ];
          $this->model_petugas->edit_admin($data, $id_role);
          session()->setFlashdata("success", "Berhasil Edit Petugas");
          return redirect()->to(base_url('halaman_petugas'));
      }
      
      public function hapus_petugas($id_role)
      {
          $dapatkan_admin = $this->model_petugas->dapatkan_petugas($id_role);
          if (isset($dapatkan_admin)) {
              $this->model_petugas->hapus_admin($id_role);
              session()->setFlashdata("success", "Berhasil Hapus Petugas");
              return redirect()->to(base_url('halaman_petugas'));
          } else {
              session()->setFlashdata("error", "Gagal Hapus Petugas");
              return redirect()->to(base_url('halaman_petugas'));
          }
      }

}
