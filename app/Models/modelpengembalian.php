<?php

namespace App\Models;

use CodeIgniter\Model;

class modelpengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $allowedFields = [
        'id_pengembalian', 
        'user_id', 
        'id_peminjaman', 
        'tanggal_pengembalian',
        'hari_keterlambatan', 
        'total_denda', 
        'uang_kembalian', 
        'uang_dibayarkan'];

    public function tambah_pengembalian($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    // query untuk method daftar_pengembalian
    // public function semua_dikembalikan()
    // {
    //     return $this->select('pengembalian.*, user.*, buku.*')
    //     ->join('user', 'user.user_id = pengembalian.user_id')
    //     ->join('buku', 'buku.buku_id = pengembalian.buku_id')
    //     ->orderBy('tanggal_pengembalian', 'DESC') // Urutan tanggal terbaru (DESC)
    //     ->get()
    //     ->getResultArray();
    // }

    public function semua_dikembalikan()
    {
        return $this->select('pengembalian.*, user.*, buku.*')
        ->join('user', 'user.user_id = pengembalian.user_id')
        ->join('buku', 'buku.buku_id = pengembalian.buku_id')
        ->orderBy('tanggal_pengembalian', 'DESC') // Urutan tanggal terbaru (DESC)
        ->get()
        ->getResultArray();
    }

    // query untuk method buku_dikembalikan by member
    public function buku_dikembalikan_by_member($user_id)
    {
        $query = $this->db->table('pengembalian');
        $result = $query->select('*')
            ->join('user', 'user.user_id = pengembalian.user_id')
            ->join('buku', 'buku.buku_id = pengembalian.buku_id')
            ->where('pengembalian.user_id', $user_id)
            ->get()
            ->getResultArray();
    
        return $result;
    }

    public function cetak_pengembalian($bulan, $tahun)
    {
        return $this->select('pengembalian.*, user.*, buku.*')
            ->join('user', 'user.user_id = pengembalian.user_id')
            ->join('buku', 'buku.buku_id = pengembalian.buku_id')
            ->where('MONTH(tanggal_pengembalian)', $bulan)
            ->where('YEAR(tanggal_pengembalian)', $tahun)
            ->orderBy('tanggal_pengembalian', 'DESC') // Urutan tanggal terbaru (DESC)
            ->get()
            ->getResultArray();
    }
      
    public function total_pengembalian()
    {
        $currentMonth = date('m'); // Mendapatkan bulan saat ini

        $query = $this->db->table($this->table)
            ->select('COUNT(DISTINCT id_pengembalian) as total_pengembalian')
            ->where("DATE_FORMAT(tanggal_pengembalian, '%m')", $currentMonth)
            ->get();

        return $query->getRow();
    }
}
    
