<?php

namespace App\Controllers;
use App\Models\model_akun;
use App\Models\model_admin;

class Login extends BaseController
{
    public function __construct()
    {
        $this->model_akun = new model_akun();
        $this->model_admin = new model_admin();
    }
    public function login()
    {
        echo view('login/login');
    }
    public function register()
    {
        return view('login/register');
    }
    // public function proses_register()
    // {
    //     $username = $this->request->getPost('username');
    //     $email = $this->request->getPost('email');
    //     $password = $this->request->getPost('password');
    //     $nama_lengkap = $this->request->getPost('nama_lengkap');
    //     $alamat = $this->request->getPost('alamat');    
    //     $data =[
    //         "username"=>$username,
    //         "email"=>$email,
    //         "password"=>$password,
    //         "nama_lengkap"=>$nama_lengkap,
    //         "alamat"=>$alamat,
    //     ];
    //     $this->model_akun->tambah_akun($data);
    //     return view('login/login');

    // }
    public function proses_register()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $alamat = $this->request->getPost('alamat');    
        

        $dapatkan_user = $this->model_akun->dapatkan_user($email)->getRow();
        if ($dapatkan_user) {
            // echo 'EMAIL SUDAH DIGUNAKAN';
            session()->setFlashdata('info', 'Email Sudah Di gunakan');
            return redirect()->to(base_url('register'));
        } else {
}
$data =[
    "username"=>$username,
    "email"=>$email,
    "password"=>$password,
    "nama_lengkap"=>$nama_lengkap,
    "alamat"=>$alamat,
];
        $this->model_akun->tambah_akun($data);
        return view('login/login');

    }
    public function proses_login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $dapatkan_user = $this->model_akun->dapatkan_user($email)->getRow();
        // dd($dapatkan_user->nama_lengkap);
        if($dapatkan_user){
            if($password == $dapatkan_user->password){
                session()->set([
                    'email'=>$dapatkan_user->email,
                    'user_id'=>$dapatkan_user->user_id,
                    'nama_lengkap'=>$dapatkan_user->nama_lengkap,
                    'username'=>$dapatkan_user->username,
                    'status_login'=>TRUE,

                ]);
                session()->setFlashdata('success', 'Anda Berhasil Login');

              return redirect()->to(base_url('/'));

            } else{
                echo'password salah';
            }
            } else{
                echo'akun ini tidak terdaftar';
                
            }
    }
    public function login_admin()
    {
        return view('login_admin/login_admin');
       }

    public function proses_login_admin()
    {
        $request = \Config\Services::request();
        $email = $request->getVar('email');
        $password = $request->getVar('password');

        $dapatkan_admin = $this->model_admin->dapatkan_admin($email)->getRow();
    
        if ($dapatkan_admin) {
            // Memeriksa kecocokan password tanpa menggunakan password_verify
        if ($password === $dapatkan_admin ->password) {
        if ($dapatkan_admin ->role == 'admin') {
                    // Menyimpan data user ke dalam sesi
                    session()->set([
                        'email' => $dapatkan_admin ->email,
                        'status_login' => TRUE,

                    ]);

                    session()->setFlashdata('success', 'Anda Berhasil Login');
                    return redirect()->to(base_url('dashboard_admin'));
                } else {
                    session()->set([
                        'email' => $dapatkan_admin ->email,
                        'status_login' => TRUE,

                    ]);

                    session()->setFlashdata('success', 'Anda Berhasil Login');
                    return redirect()->to(base_url('/dashboard_petugas'));
                }
                
            } else {
                session()->setFlashdata('error', 'Password Salah');
                // return redirect()->to(base_url('/login_admin'));
                echo 'pw salah  ad';
            }
        } else {
            session()->setFlashdata('error', 'Akun Ditemukan!');
            // return redirect()->to(base_url('/login_admin'));
            echo 'akun ga ad';

        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }

}
