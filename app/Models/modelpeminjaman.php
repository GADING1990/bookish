<?php

namespace App\Models;

use CodeIgniter\Model;

class modelpeminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'peminjaman_id';
    protected $allowedFields = ['peminjaman_id', 'user_id', 'buku_id', 'tanggal_peminjaman','sinopsis','tanggal_pengembalian', 'status_peminjaman', 'total_pinjam', 'total_pengembalian'];

    public function dapatkan_peminjaman($email = false)
    {
        if ($email === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['email' => $email]);
        }
    }

    public function dapatkan_peminjaman_byId($peminjaman_id = false)
    {
        if ($peminjaman_id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['peminjaman_id' => $peminjaman_id]);
        }
    }

    // query untuk method proses_pinjam_buku
    public function tambah_peminjaman($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    // query untuk method buku_dipinjam
    public function buku_dipinjam_by_member($user_id)
    {
        $query = $this->db->table('peminjaman');
        $result = $query->select('*')
            ->join('user', 'user.user_id = peminjaman.user_id')
            ->join('buku', 'buku.buku_id = peminjaman.buku_id')
            ->join('kategoribuku', 'kategoribuku.kategori_id = buku.kategori_id')
            ->where('peminjaman.user_id', $user_id)
            ->where('status_peminjaman', 'di-pinjam')
            ->get()
            ->getResultArray();
    
        return $result;
    }

    // query untuk method proses_pinjam_buku
    public function cek_buku_dipinjam($user_id, $buku_id)
    {
        return $this->where('user_id', $user_id)
                    ->where('buku_id', $buku_id)
                    ->where('status_peminjaman', 'di-pinjam')
                    ->countAllResults() > 0;
    }
    
    // query untuk method daftar_peminjam
    public function getAllStatusDipinjam()
    {
        return $this->select('peminjaman.*, user.*, buku.*, kategoribuku.nama_kategori')
            ->join('user', 'user.user_id = peminjaman.user_id')
            ->join('buku', 'buku.buku_id = peminjaman.buku_id')
            ->join('kategoribuku', 'kategoribuku.kategori_id = buku.kategori_id')
            ->where('status_peminjaman', 'di-pinjam')
            ->orderBy('tanggal_peminjaman', 'DESC') // Urutan tanggal terbaru (DESC)
            ->get()
            ->getResultArray();
    }

    // query untuk method daftar_pengembalian
    public function getAllStatusDikembalikan()
    {
        return $this->select('peminjaman.*, user.*, buku.*')
        ->join('user', 'user.user_id = peminjaman.user_id')
        ->join('buku', 'buku.buku_id = peminjaman.buku_id')
        ->where('status_peminjaman', 'di-kembalikan')
        ->orderBy('tanggal_pengembalian', 'DESC') // Urutan tanggal terbaru (DESC)
        ->get()
        ->getResultArray();
    }

    // query untuk method proses_edit_peminjaman
    public function edit_status_peminjaman($data, $user_id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $user_id);
        return $builder->update($data);
    }
    
    public function cetak_peminjaman($status_peminjaman)
    {
        return $this->select('peminjaman.*, user.*, buku.*')
            ->join('user', 'user.user_id = peminjaman.user_id')
            ->join('buku', 'buku.buku_id = peminjaman.buku_id')
            ->where('status_peminjaman', $status_peminjaman)
            ->orderBy('tanggal_peminjaman', 'DESC') // Urutan tanggal terbaru (DESC)
            ->get()
            ->getResultArray();
    }
    public function total_peminjaman()
    {
        $currentMonth = date('m'); // Mendapatkan bulan saat ini

        $query = $this->db->table($this->table)
            ->select('COUNT(DISTINCT peminjaman_id) as total_peminjaman')
            ->where("DATE_FORMAT(tanggal_peminjaman, '%m')", $currentMonth)
            ->where('status_peminjaman', 'di-pinjam')
            ->get();

        return $query->getRow();
    }
}