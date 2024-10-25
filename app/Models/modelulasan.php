<?php

namespace App\Models;

use CodeIgniter\Model;

class modelulasan extends Model
{
    protected $table = 'ulasan_buku';
    protected $primaryKey = 'ulasan_id';
    protected $allowedFields = [
        'ulasan_id', 
        'user_id',
        'buku_id',
        'ulasan',
        'rating',
    ];

    public function tambah_ulasan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function cek_user_ulasan($user_id, $buku_id)
    {
        return $this->getWhere([
            'user_id' => $user_id,
            'buku_id' => $buku_id,
        ])->getRow();
    }

    public function ulasanByBuku($buku_id)
    {
        return $this->select('ulasan_buku.*, user.*, buku.*')
        ->join('user', 'user.user_id = ulasan_buku.user_id')
        ->join('buku', 'buku.buku_id = ulasan_buku.buku_id')
        ->where('ulasan_buku.buku_id', $buku_id) // Ubah agar spesifik ke kolom ulasan_buku
        ->get()
        ->getResultArray();
    }

    public function avgRating($buku_id)
    {
        $query = $this->db->query('SELECT AVG(rating) as average_rating FROM ' . $this->table . ' WHERE buku_id = ?', [$buku_id]);
        return $query->getRow()->average_rating;
    }
}