<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPeminjaman extends Model
{
    protected $table            = 'tbl_peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'no_pinjam',
        'id_anggota',
        'id_buku',
        'tgl_pinjam',
        'tgl_kembali',
        'lama_pinjam',
        'status',
        'tgl_pengembalian',
        'denda',
        'keterangan',
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
        'no_pinjam'   => 'required|max_length[50]',
        'id_anggota'  => 'required|is_natural_no_zero',
        'id_buku'     => 'required|is_natural_no_zero',
        'tgl_pinjam'  => 'required|valid_date',
        'lama_pinjam' => 'required|is_natural_no_zero',
        'status'      => 'required|in_list[pengajuan,diterima,ditolak,dikembalikan]',
    ];

    protected $validationMessages   = [
        'no_pinjam' => [
            'required'   => 'Nomor pinjam wajib diisi.',
            'max_length' => 'Nomor pinjam maksimal 50 karakter.',
        ],
        'id_anggota' => [
            'required'           => 'Anggota wajib dipilih.',
            'is_natural_no_zero' => 'Anggota tidak valid.',
        ],
        'id_buku' => [
            'required'           => 'Buku wajib dipilih.',
            'is_natural_no_zero' => 'Buku tidak valid.',
        ],
        'tgl_pinjam' => [
            'required'     => 'Tanggal pinjam wajib diisi.',
            'valid_date'   => 'Format tanggal tidak valid.',
        ],
        'lama_pinjam' => [
            'required'        => 'Lama pinjam wajib diisi.',
            'is_natural_no_zero' => 'Lama pinjam harus angka positif.',
        ],
        'status' => [
            'required'  => 'Status wajib dipilih.',
            'in_list'   => 'Status tidak valid.',
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

    /**
     * Get all peminjaman for a specific member with related data
     */
    public function getPeminjamanByAnggota($id_anggota)
    {
        return $this->select('tbl_peminjaman.*, tbl_buku.judul_buku, tbl_buku.cover, tbl_anggota.nama_anggota')
                    ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku')
                    ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
                    ->where('tbl_peminjaman.id_anggota', $id_anggota)
                    ->orderBy('tbl_peminjaman.id_peminjaman', 'DESC')
                    ->findAll();
    }

    /**
     * Get peminjaman by status and anggota
     */
    public function getPeminjamanByStatus($id_anggota, $status)
    {
        return $this->select('tbl_peminjaman.*, tbl_buku.judul_buku, tbl_buku.cover, tbl_anggota.nama_anggota')
                    ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku')
                    ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
                    ->where('tbl_peminjaman.id_anggota', $id_anggota)
                    ->where('tbl_peminjaman.status', $status)
                    ->orderBy('tbl_peminjaman.id_peminjaman', 'DESC')
                    ->findAll();
    }

    /**
     * Get detail peminjaman
     */
    public function getDetailPeminjaman($id_peminjaman)
    {
        return $this->select('tbl_peminjaman.*, tbl_buku.judul_buku, tbl_buku.cover, tbl_buku.isbn, tbl_buku.tahun, tbl_anggota.nama_anggota, tbl_anggota.nim')
                    ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku')
                    ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
                    ->where('tbl_peminjaman.id_peminjaman', $id_peminjaman)
                    ->first();
    }
}
