<?php

namespace App\Models;

use CodeIgniter\Model;

class model_daftar_buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'buku_id ';
    protected $allowedFields = ['buku_id', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'cover', 'kategori_id', 'id_sub_kategori'];

    public function tambah_daftar_buku($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }
    
    public function semua_daftar_buku()
    {
        $query = $this->db->table($this->table);
        $batasan = $query->select('*')
            ->join('kategoribuku', 'kategoribuku.kategori_id  = '.$this->table.'.kategori_id ', 'left')
            ->join('sub_kategori', 'sub_kategori.id_sub_kategori = '.$this->table.'.id_sub_kategori', 'left')
            ->orderBy('buku_id', 'ASC') 
            ->get()
            ->getResultArray();
        return $batasan;
    }
    public function edit_buku_dipinjam($buku_id, $stok_baru)
    {
        $builder = $this->db->table($this->table);
        $builder->where('buku_id', $buku_id);
        
        $builder->update(['stok' => $stok_baru]);
                
        return $this->db->affectedRows(); 
    }

    public function dapatkan_daftar_Buku($buku_id = false)
    {
        $this->select('*');
        $this->join('kategoribuku', 'kategoribuku.kategori_id = '.$this->table.'.kategori_id');

        if ($buku_id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['buku_id' => $buku_id])->getRow();
        }
    }

    public function cari_buku($cari_buku)
    {
        $query = $this->db->table($this->table);
        $batasan = $query->select('*')
            ->join('kategoribuku', 'kategoribuku.kategori_id = ' . $this->table . '.kategori_id', 'left')
            ->join('sub_kategori', 'sub_kategori.id_sub_kategori = ' . $this->table . '.id_sub_kategori', 'left')
            ->like('judul', $cari_buku) 
            ->orLike('kategoribuku.nama_kategori', $cari_buku)
            ->orderBy('buku_id', 'ASC')
            ->get()
            ->getResultArray();
        return $batasan;
    }
    

    public function edit_daftar_buku($data, $buku_id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('buku_id', $buku_id);
        return $builder->update($data);
    }
    public function ubah_stok_baru($data_stok_baru, $buku_id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('buku_id', $buku_id);
        return $builder->update($data_stok_baru);
    }

    public function hapus_daftar_buku($buku_id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['buku_id' => $buku_id]);
    }

    public function total_buku()
    {
        $query = $this->db->table($this->table)
        
            ->select('COUNT(DISTINCT  buku_id) as total_buku')
            ->get();

        return $query->getRow();
    }
}