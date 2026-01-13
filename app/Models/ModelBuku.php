<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBuku extends Model
{
    protected $table            = 'tbl_buku';
    protected $primaryKey       = 'id_buku';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_buku',
        'judul_buku',
        'id_kategori',
        'id_rak',
        'id_penerbit',
        'id_penulis',
        'tahun',
        'isbn',
        'halaman',
        'jumlah',
        'cover',
        'bahasa',
        'sinopsis',
        'jml_tersedia',
        'jml_dipinjam',
        
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'kode_buku'   => 'required|max_length[50]',
        'judul_buku'  => 'required|min_length[3]|max_length[255]',
        'id_kategori' => 'required|is_natural_no_zero',
        'id_rak'      => 'required|is_natural_no_zero',
        'id_penerbit' => 'required|is_natural_no_zero',
        'id_penulis'  => 'required|is_natural_no_zero',
        'tahun'       => 'required|regex_match[/^[0-9]{4}$/]',
        'isbn'        => 'permit_empty|max_length[20]',
        'halaman'     => 'permit_empty|is_natural',
        'jumlah'      => 'required|is_natural',
        'bahasa'      => 'permit_empty|max_length[50]',
    ];
    protected $validationMessages   = [
        'kode_buku' => [
            'required'   => 'Kode buku wajib diisi.',
            'max_length' => 'Kode buku maksimal 50 karakter.',
        ],
        'judul_buku' => [
            'required'   => 'Judul buku wajib diisi.',
            'min_length' => 'Judul buku minimal 3 karakter.',
            'max_length' => 'Judul buku maksimal 255 karakter.',
        ],
        'id_kategori' => [
            'required' => 'Kategori wajib dipilih.',
            'is_natural_no_zero' => 'Kategori tidak valid.',
        ],
        'id_rak' => [
            'required' => 'Rak wajib dipilih.',
            'is_natural_no_zero' => 'Rak tidak valid.',
        ],
        'id_penerbit' => [
            'required' => 'Penerbit wajib dipilih.',
            'is_natural_no_zero' => 'Penerbit tidak valid.',
        ],
        'id_penulis' => [
            'required' => 'Penulis wajib dipilih.',
            'is_natural_no_zero' => 'Penulis tidak valid.',
        ],
        'tahun' => [
            'required' => 'Tahun terbit wajib diisi.',
            'regex_match' => 'Format tahun harus YYYY (4 digit).',
        ],
        'isbn' => [
            'max_length' => 'ISBN maksimal 20 karakter.',
        ],
        'halaman' => [
            'is_natural' => 'Halaman harus berupa angka positif.',
        ],
        'jumlah' => [
            'required' => 'Jumlah wajib diisi.',
            'is_natural' => 'Jumlah harus berupa angka positif.',
        ],
        'bahasa' => [
            'max_length' => 'Nama bahasa maksimal 50 karakter.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Ambil semua buku beserta relasi kategori, rak, penulis
    public function getBukuWithRelasi()
    {
        return $this->select('tbl_buku.*, tbl_kategori.nama_kategori, tbl_rak.nama_rak, tbl_penulis.nama_penulis, tbl_penerbit.nama_penerbit')
                    ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori')
                    ->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak')
                    ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_buku.id_penulis')
                    ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_buku.id_penerbit')
                    ->findAll();
    }

    // Ambil satu buku beserta relasi berdasarkan id_buku
    public function getDetailBuku($id_buku)
    {
        return $this->select('tbl_buku.*, tbl_kategori.nama_kategori, tbl_rak.nama_rak, tbl_penulis.nama_penulis, tbl_penerbit.nama_penerbit')
                    ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori')
                    ->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak')
                    ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_buku.id_penulis')
                    ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_buku.id_penerbit')
                    ->where('tbl_buku.id_buku', $id_buku)
                    ->first();
    }

    public function BukuBaru()
    {
        return $this->db->table('tbl_buku')
                ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori')
                    ->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak')
                    ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_buku.id_penulis')
                    ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_buku.id_penerbit')
                    ->orderBy('tbl_buku.id_buku', 'DESC')
                    ->limit(10)
                    ->get()->getResultArray();
    }

}
