<?php

namespace App\Models;

use CodeIgniter\Model;

class model_sub_kategori extends Model
{
    protected $table = 'sub_kategori';
    protected $primaryKey = 'id_sub_kategori';
    protected $allowedFields = ['id_sub_kategori', 'nama_sub_kategori'];

    
    public function kode_sub_kategori() {
        $query = $this->db->table('sub_kategori');
        $count = $query->countAllResults();
    
        if ($count == 0) {
            return 'S-KT-'; // Jika tidak ada data, beri nomor otomatis pertama
        } else {
            // Ambil nomor otomatis terkecil yang belum digunakan
            $usedCodes = $query->select('id_sub_kategori')->get()->getResultArray();
            $existingNumbers = array_map(function ($code) {
                return (int)substr($code['id_sub_kategori'], strlen('S-KT-'));
            }, $usedCodes);
    
            $newNumber = min(array_diff(range(1, $count + 1), $existingNumbers));
    
            $newCode = 'S-KT-' . sprintf("%03d", $newNumber);
    
            return $newCode;
        }
    }
    public function tambah_sub_kategori($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function semua_sub_kategori()
    {
       
            $query = $this->db->table($this->table);
            $batasan = $query->select('*')
            ->join('kategoribuku', 'kategoribuku.kategori_id = '.$this->table.'.kategori_id')
                ->orderBy('id_sub_kategori', 'ASC') 
                ->get()
                ->getResultArray();
            return $batasan;
        
    }


    public function dapatkan_sub_kategori($id_sub_kategori = false)
    {
        if ($id_sub_kategori === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_sub_kategori' => $id_sub_kategori]);
        }
    }

    public function edit_sub_kategori($data, $id_sub_kategori)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_sub_kategori', $id_sub_kategori);
        return $builder->update($data);
    }
    public function total_sub_kategori()
    {
        $query = $this->db->table($this->table)
            ->select('COUNT(DISTINCT id_sub_kategori) as total_sub_kategori')
            ->get();
            return $query->getRow();
    }

    public function hapus_sub_kategori($id_sub_kategori)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_sub_kategori' => $id_sub_kategori]);
    }
    public function getSubByKategori($kategori_id)
    {
        $query = $this->db->table($this->table);
        $batasan = $query->select('kategoribuku.*, sub_kategori.*')
            ->join('kategoribuku', 'kategoribuku.kategori_id = sub_kategori.kategori_id')
            ->where('kategoribuku.kategori_id', $kategori_id)
            ->orderBy('nama_sub_kategori', 'ASC') 
            ->get()->getResultArray();
        return $batasan;
        $query = $this->db->table($this->table);
    }
}