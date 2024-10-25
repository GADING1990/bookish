<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 // member daftar member
$routes->get('/', 'Home::beranda');
$routes->get('login', 'Login::login');
$routes->get('register', 'Login::register');
$routes->post('proses_register', 'Login::proses_register');
$routes->post('proses_login', 'Login::proses_login');
$routes->get('peminjaman_buku/(:segment)', 'Member::peminjaman_buku/$1');
$routes->post('proses_peminjaman_buku', 'Member::proses_peminjaman_buku');
$routes->post('proses_tambah_koleksi', 'Member::proses_tambah_koleksi');
$routes->get('koleksi_buku', 'Member::koleksi_buku');
$routes->get('hapus_koleksi_buku/(:segment)', 'Member::hapus_koleksi_buku/$1');
$routes->get('riwayat_pinjam', 'Member::riwayat_pinjam');
$routes->get('riwayat_kembali', 'Member::riwayat_kembali');
$routes->post('proses_ulasan', 'Member::proses_ulasan');
$routes->post('proses_login', 'Login::proses_login');


// Admin
$routes->get('dashboard_admin', 'Admin::dashboard_admin');

//Admin daftar user
$routes->post('edit_user', 'Admin::edit_user');
$routes->get('halaman_user', 'Admin::halaman_user');
$routes->get('hapus_user/(:segment)', 'Admin::hapus_user/$1');

//Admin daftar petugas
$routes->get('halaman_petugas', 'Admin::halaman_petugas');
$routes->post('proses_tambah_petugas', 'Admin::proses_tambah_petugas');
$routes->post('proses_edit_petugas', 'Admin::proses_edit_petugas');
$routes->get('hapus_petugas/(:segment)', 'Admin::hapus_petugas/$1');
//Admin daftar admin
$routes->get('login_admin', 'Login::login_admin');
$routes->get('halaman_admin', 'Admin::halaman_admin');
$routes->post('proses_login_admin', 'Login::proses_login_admin');
$routes->post('proses_tambah_Admin', 'Admin::proses_tambah_Admin');
$routes->post('proses_edit_admin', 'Admin::proses_edit_admin');
$routes->get('hapus_admin/(:segment)', 'Admin::hapus_admin/$1');

//Admin tambah daftar kategori buku
$routes->get('halaman_kategoribuku', 'Admin::halaman_kategoribuku');
$routes->post('proses_tambah_kategori_buku', 'Admin::proses_tambah_kategori_buku');
$routes->post('proses_edit_kategori_buku', 'Admin::proses_edit_kategori_buku');
$routes->get('hapus_kategori_buku/(:segment)', 'Admin::hapus_kategori_buku/$1');

//Admin tambah daftar sub kategori buku
$routes->get('halaman_sub_kategori', 'Admin::halaman_sub_kategori');
$routes->post('proses_tambah_sub_kategori', 'Admin::proses_tambah_sub_kategori');
$routes->post('proses_edit_sub_kategori', 'Admin::proses_edit_sub_kategori');
$routes->get('hapus_sub_kategori/(:segment)', 'Admin::hapus_sub_kategori/$1');

//Admin tambah daftar buku
$routes->get('halaman_daftar_buku', 'Admin::halaman_daftar_buku');
$routes->post('admin/getDataByKategori', 'Admin::loadSubKategori');
$routes->post('proses_tambah_buku', 'Admin::proses_tambah_buku');
$routes->post('proses_edit_buku', 'Admin::proses_edit_buku');
$routes->post('proses_edit_kategori_sub_buku', 'Admin::proses_edit_kategori_sub_buku');
$routes->get('hapus_daftar_buku/(:segment)', 'Admin::hapus_daftar_buku/$1');

//dashboard petugas
$routes->get('dashboard_petugas', 'Petugas::dashboard_petugas');

// Petugas
$routes->get('halaman_daftar_peminjaman', 'Petugas::halaman_daftar_peminjaman');
$routes->get('halaman_daftar_pengembalian', 'Petugas::halaman_daftar_pengembalian');
$routes->post('proses_edit_peminjaman', 'Petugas::proses_edit_peminjaman');
$routes->post('cetak_peminjaman', 'Petugas::cetak_peminjaman');
$routes->post('cetak_pengembalian', 'Petugas::cetak_pengembalian');
$routes->get('login', 'Login::login');
$routes->get('logout', 'Login::logout');
