<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengaturan extends Model
{
    protected $table            = 'tbl_web';
    protected $primaryKey       = 'id_web';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_web',
        'alamat' ,
        'kecamatan' ,
        'kab_kota' ,
        'no_telp' ,
        'logo' ,
        'kode_pos'
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
        'nama_web' => 'required|max_length[100]',
        'alamat'   => 'required|max_length[255]',
        'kecamatan'=> 'required|max_length[100]',
        'kab_kota' => 'required|max_length[100]',
        'no_telp'  => 'required|max_length[15]',
        'kode_pos' => 'required|max_length[10]',
    ];
    protected $validationMessages   = [
        'nama_web' => [
            'required'    => 'Nama web wajib diisi.',
            'max_length'  => 'Nama web maksimal 100 karakter.'
        ],
        'alamat' => [
            'required'    => 'Alamat wajib diisi.',
            'max_length'  => 'Alamat maksimal 255 karakter.'
        ],
        'kecamatan' => [
            'required'    => 'Kecamatan wajib diisi.',
            'max_length'  => 'Kecamatan maksimal 100 karakter.'
        ],
        'kab_kota' => [
            'required'    => 'Kabupaten/Kota wajib diisi.',
            'max_length'  => 'Kabupaten/Kota maksimal 100 karakter.'
        ],
        'no_telp' => [
            'required'    => 'Nomor telepon wajib diisi.',
            'max_length'  => 'Nomor telepon maksimal 15 karakter.'
        ],
        'kode_pos' => [
            'required'    => 'Kode pos wajib diisi.',
            'max_length'  => 'Kode pos maksimal 10 karakter.'
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
}
