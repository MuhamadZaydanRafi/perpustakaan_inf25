<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAnggota extends Model
{
    protected $table            = 'tbl_anggota';
    protected $primaryKey       = 'id_anggota';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nim',
        'nama_anggota',
        'password',
        'id_kelas',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'foto',
            'verifikasi'
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
        'nama_anggota'  => 'required|min_length[3]|max_length[200]',
        'password'      => 'required|min_length[6]|max_length[255]',
        'id_kelas'      => 'required',
        'jenis_kelamin' => 'required|in_list[Laki-Laki,Perempuan]',
        'no_hp'         => 'required|min_length[10]|max_length[15]',
        'alamat'        => 'required|min_length[5]|max_length[500]',

    ];
    protected $validationMessages   = [
        'nama_anggota' => [
            'required'   => 'Nama anggota wajib diisi.',
            'min_length' => 'Nama anggota minimal 3 karakter.',
            'max_length' => 'Nama anggota maksimal 200 karakter.',
        ],
        'password' => [
            'required'   => 'Password wajib diisi.',
            'min_length' => 'Password minimal 6 karakter.',
            'max_length' => 'Password maksimal 255 karakter.',
        ],
        'id_kelas' => [
            'required'   => 'Kelas wajib diisi.',
        ],
        'jenis_kelamin' => [
            'required'   => 'Jenis kelamin wajib diisi.',
            'in_list'    => 'Jenis kelamin harus Laki-Laki atau Perempuan.',
        ],
        'no_hp' => [
            'required'   => 'No HP wajib diisi.',
            'min_length' => 'No HP minimal 10 digit.',
            'max_length' => 'No HP maksimal 15 digit.',
        ],
        'alamat' => [
            'required'   => 'Alamat wajib diisi.',
            'min_length' => 'Alamat minimal 5 karakter.',
            'max_length' => 'Alamat maksimal 500 karakter.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

      protected function hashPassword(array $data)
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['data']['password']);
        }
        return $data;
    }
    public function getAnggotaWithKelas()
    {
       return $this->select('tbl_anggota.*, tbl_kelas.nama_kelas')
                    ->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_anggota.id_kelas')
                    ->findAll();
    }

    // Relasi satu data
    public function getDetailkelas($id_anggota)
    {
        return $this->select('tbl_anggota.*, tbl_kelas.nama_kelas')
                    ->join('tbl_kelas', 'tbl_kelas.id_kelas = tbl_anggota.id_kelas')
                    ->where('tbl_anggota.id_anggota', $id_anggota)
                    ->first();
    }

}
