<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelEbook extends Model
{
    protected $table            = 'tbl_ebook';
    protected $primaryKey       = 'id_ebook';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul_ebook',
        'file_ebook',
        'id_kategori',
        'id_penulis',
        'id_penerbit',
        'tahun',
        'isbn',
        'bahasa',
        'halaman',
        'cover',
        'sinopsis',
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
        'judul_ebook'  => 'required|min_length[3]|max_length[255]',
        'id_kategori'  => 'required|is_natural_no_zero',
        'id_penulis'   => 'required|is_natural_no_zero',
        'id_penerbit'  => 'required|is_natural_no_zero',
        'tahun'        => 'required|regex_match[/^[0-9]{4}$/]',
        'isbn'         => 'permit_empty|max_length[20]',
        'bahasa'       => 'permit_empty|max_length[50]',
        'halaman'      => 'permit_empty|is_natural',
    ];
    protected $validationMessages   = [
        'judul_ebook' => [
            'required'   => 'Judul ebook wajib diisi.',
            'min_length' => 'Judul ebook minimal 3 karakter.',
            'max_length' => 'Judul ebook maksimal 255 karakter.',
        ],
        'id_kategori' => [
            'required'           => 'Kategori wajib dipilih.',
            'is_natural_no_zero' => 'Kategori tidak valid.',
        ],
        'id_penulis' => [
            'required'           => 'Penulis wajib dipilih.',
            'is_natural_no_zero' => 'Penulis tidak valid.',
        ],
        'id_penerbit' => [
            'required'           => 'Penerbit wajib dipilih.',
            'is_natural_no_zero' => 'Penerbit tidak valid.',
        ],
        'tahun' => [
            'required'      => 'Tahun wajib diisi.',
            'regex_match'   => 'Format tahun tidak valid. Gunakan format YYYY.',
        ],
        'isbn' => [
            'max_length' => 'ISBN maksimal 20 karakter.',
        ],
        'bahasa' => [
            'max_length' => 'Bahasa maksimal 50 karakter.',
        ],
        'halaman' => [
            'is_natural' => 'Halaman harus berupa angka positif.',
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

     public function getEbookWithRelasi()
    {
        return $this->select('tbl_ebook.*, tbl_kategori.nama_kategori, tbl_penulis.nama_penulis, tbl_penerbit.nama_penerbit')
                    ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_ebook.id_kategori')
                    ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_ebook.id_penulis')
                    ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_ebook.id_penerbit')
                    ->findAll();
    }

    // Ambil satu e-book beserta relasi berdasarkan id_ebook
    public function getDetailEbook($id_ebook)
    {
        return $this->select('tbl_ebook.*, tbl_kategori.nama_kategori, tbl_penulis.nama_penulis, tbl_penerbit.nama_penerbit')
                    ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_ebook.id_kategori')
                    ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_ebook.id_penulis')
                    ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_ebook.id_penerbit')
                    ->where('tbl_ebook.id_ebook', $id_ebook)
                    ->first();
    }

    public function EbookBaru()
    {
        return $this->db->table('tbl_ebook')
                ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_ebook.id_kategori')
                    ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_ebook.id_penulis')
                    ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_ebook.id_penerbit')
                    ->orderBy('tbl_ebook.id_ebook', 'DESC')
                    ->limit(10)
                    ->get()->getResultArray();
    }
               
}
