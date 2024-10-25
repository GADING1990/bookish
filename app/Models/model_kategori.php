<?php

namespace App\Models;

use CodeIgniter\Model;

class model_kategori extends Model
{
    protected $table = 'kategoribuku';
    protected $primaryKey = 'katgori_id';
    protected $allowedFields = ['kategori_id', 'nama_kategori'];

    public function kode_kategori() {
        $query = $this->db->table('kategoribuku');
        $count = $query->countAllResults();
    
        if ($count == 0) {
            return 'KT-001'; // Jika tidak ada data, beri nomor otomatis pertama
        } else {
            // Ambil nomor otomatis terkecil yang belum digunakan
            $usedCodes = $query->select('kategori_id')->get()->getResultArray();
            $existingNumbers = array_map(function ($code) {
                return (int)substr($code['kategori_id'], strlen('KT-'));
            }, $usedCodes);
    
            $newNumber = min(array_diff(range(1, $count + 1), $existingNumbers));
    
            $newCode = 'KT-' . sprintf("%03d", $newNumber);
    
            return $newCode;
        }
    }
    public function tambah_kategori_buku($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function semua_kategori_buku()
    {
        $query = $this->db->table($this->table);
        $batasan = $query->select('*')
            ->get()->getResultArray();
        return $batasan;
    }


    public function dapatkanKategoriBuku($kategori_id = false)
    {
        if ($kategori_id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['kategori_id' => $kategori_id]);
        }
    }

    public function edit_kategori_buku($data, $kategori_id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('kategori_id', $kategori_id);
        return $builder->update($data);
    }
    public function total_kategori()
    {
        $query = $this->db->table($this->table)
        
            ->select('COUNT(DISTINCT  kategori_id) as total_kategori')
            ->get();

        return $query->getRow();
    }
    public function hapus_kategori_buku($kategori_id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['kategori_id' => $kategori_id]);
    }
}