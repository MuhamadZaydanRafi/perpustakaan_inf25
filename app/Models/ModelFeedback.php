<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFeedback extends Model
{
    protected $table            = 'tbl_feedback';
    protected $primaryKey       = 'id_feedback';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'komentar',
        'keluhan',
        'penilaian',
        'saran'
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
        'nama' => 'required|max_length[100]',
        'komentar' => 'required',
        'keluhan' => 'required',
        'penilaian' => 'required',
        'saran' => 'required'

    ];
    protected $validationMessages   = [
        'nama' => [
            'required' => 'Nama wajib diisi.',
            'max_length' => 'Nama maksimal 100 karakter.'
        ],
        'komentar' => [
            'required' => 'Komentar wajib diisi.'
        ],
        'keluhan' => [
            'required' => 'Keluhan wajib diisi.'
        ],
        'penilaian' => [
            'required' => 'Penilaian wajib diisi.'
        ],
        'saran' => [
            'required' => 'Saran wajib diisi.'
        ]
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
