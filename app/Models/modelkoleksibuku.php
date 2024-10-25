<?php

namespace App\Models;

use CodeIgniter\Model;

class modelkoleksibuku extends Model
{
    protected $table = 'koleksi_pribadi';
    protected $primaryKey = 'koleksi_id';
    protected $allowedFields = [
        'koleksi_id', 
        'user_id',
        'buku_id',
        'kategori_id',
    ];

    public function tambah_koleksi($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

     // query untuk method buku_dikembalikan by member
     public function semua_koleksi_by_member($user_id)
     {
         $query = $this->db->table('koleksi_pribadi');
         $result = $query->select('*')
             ->join('user', 'user.user_id = koleksi_pribadi.user_id')
             ->join('buku', 'buku.buku_id = koleksi_pribadi.buku_id')
             ->join('kategoribuku', 'kategoribuku.kategori_id = buku.kategori_id')
             ->where('koleksi_pribadi.user_id', $user_id)
             ->get()
             ->getResultArray();
     
         return $result;
     }

    public function cek_user_koleksi($user_id, $buku_id)
    {
        return $this->getWhere([
            'user_id' => $user_id,
            'buku_id' => $buku_id,
        ])->getRow();
    }

    public function dapatkan_buku_koleksi($buku_id = false)
    {
        $this->select('*');
        $this->join('kategoribuku', 'kategoribuku.kategori_id = '.$this->table.'.kategori_id');

        if ($buku_id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['buku_id' => $buku_id])->getRow();
        }
    }

    public function hapus_koleksi_buku($buku_id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['buku_id' => $buku_id]);
    }


}