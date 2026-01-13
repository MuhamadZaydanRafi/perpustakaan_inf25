<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelPeminjaman;
use App\Models\ModelBuku;
use App\Models\ModelAnggota;

class Peminjaman extends BaseController
{
    protected $ModelPeminjaman;
    protected $ModelBuku;
    protected $ModelAnggota;

    public function __construct()
    {
        $this->ModelPeminjaman = new ModelPeminjaman();
        $this->ModelBuku = new ModelBuku();
        $this->ModelAnggota = new ModelAnggota();
        helper('form');
    }

    /**
     * Display all peminjaman pengajuan (pending)
     */
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Get all pending peminjaman ordered by anggota
        $peminjamanList = $db->table('tbl_peminjaman')
                            ->select('tbl_peminjaman.*, tbl_buku.judul_buku, tbl_buku.cover, tbl_anggota.nama_anggota, tbl_anggota.nim')
                            ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku')
                            ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
                            ->where('tbl_peminjaman.status', 'pengajuan')
                            ->orderBy('tbl_peminjaman.id_anggota', 'ASC')
                            ->orderBy('tbl_peminjaman.id_peminjaman', 'DESC')
                            ->get()->getResultArray();
        
        // Group by id_anggota
        $peminjamanGrouped = [];
        foreach ($peminjamanList as $p) {
            $id_anggota = $p['id_anggota'];
            if (!isset($peminjamanGrouped[$id_anggota])) {
                $peminjamanGrouped[$id_anggota] = [
                    'anggota_info' => [
                        'id_anggota' => $p['id_anggota'],
                        'nim' => $p['nim'],
                        'nama_anggota' => $p['nama_anggota'],
                    ],
                    'peminjaman' => []
                ];
            }
            $peminjamanGrouped[$id_anggota]['peminjaman'][] = $p;
        }
        
        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'pengajuan',
            'page'    => 'admin/peminjaman/v_index',
            'judul'   => 'Pengajuan Peminjaman',
            'peminjaman_grouped' => $peminjamanGrouped,
        ];
        return view('v_template_Admin', $data);
    }

    /**
     * Display detail peminjaman
     */
    public function detail($id_peminjaman)
    {
        $peminjaman = $this->ModelPeminjaman->getDetailPeminjaman($id_peminjaman);

        if (!$peminjaman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data peminjaman tidak ditemukan');
        }

        $data = [
            'menu'       => 'peminjaman',
            'submenu'    => 'pengajuan',
            'page'       => 'admin/peminjaman/v_detail',
            'judul'      => 'Detail Pengajuan Peminjaman',
            'peminjaman' => $peminjaman,
        ];
        return view('v_template_Admin', $data);
    }

    /**
     * Approve peminjaman (set status to diterima)
     */
    public function setuju($id_peminjaman)
    {
        $peminjaman = $this->ModelPeminjaman->find($id_peminjaman);

        if (!$peminjaman) {
            return redirect()->back()->with('errors', 'Data peminjaman tidak ditemukan');
        }

        if ($peminjaman['status'] != 'pengajuan') {
            return redirect()->back()->with('errors', 'Hanya pengajuan dengan status "pengajuan" yang bisa disetujui');
        }

        $data = ['status' => 'diterima'];

        if (!$this->ModelPeminjaman->update($id_peminjaman, $data)) {
            return redirect()->back()->with('errors', $this->ModelPeminjaman->errors());
        }

        session()->setFlashdata('success', 'Pengajuan peminjaman telah disetujui.');
            return redirect()->to('admin/peminjaman');
    }

    /**
     * Reject peminjaman (set status to ditolak)
     */
    public function tolak($id_peminjaman)
    {
        $peminjaman = $this->ModelPeminjaman->find($id_peminjaman);

        if (!$peminjaman) {
            return redirect()->back()->with('errors', 'Data peminjaman tidak ditemukan');
        }

        if ($peminjaman['status'] != 'pengajuan') {
            return redirect()->back()->with('errors', 'Hanya pengajuan dengan status "pengajuan" yang bisa ditolak');
        }

        $data = ['status' => 'ditolak'];

        if (!$this->ModelPeminjaman->update($id_peminjaman, $data)) {
            return redirect()->back()->with('errors', $this->ModelPeminjaman->errors());
        }

        session()->setFlashdata('success', 'Pengajuan peminjaman telah ditolak.');
            return redirect()->to('admin/peminjaman');
    }

    /**
     * Display all approved peminjaman (diterima)
     */
    public function diterima()
    {
        $db = \Config\Database::connect();
        // fetch diterima and group by anggota
        $peminjamanList = $db->table('tbl_peminjaman')
                        ->select('tbl_peminjaman.*, tbl_buku.judul_buku, tbl_buku.cover, tbl_anggota.nama_anggota, tbl_anggota.nim')
                        ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku')
                        ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
                        ->where('tbl_peminjaman.status', 'diterima')
                        ->orderBy('tbl_peminjaman.id_anggota', 'ASC')
                        ->orderBy('tbl_peminjaman.id_peminjaman', 'DESC')
                        ->get()->getResultArray();

        $peminjamanGrouped = [];
        foreach ($peminjamanList as $p) {
            $id_anggota = $p['id_anggota'];
            if (!isset($peminjamanGrouped[$id_anggota])) {
                $peminjamanGrouped[$id_anggota] = [
                    'anggota_info' => [
                        'id_anggota' => $p['id_anggota'],
                        'nim' => $p['nim'],
                        'nama_anggota' => $p['nama_anggota'],
                    ],
                    'peminjaman' => []
                ];
            }
            $peminjamanGrouped[$id_anggota]['peminjaman'][] = $p;
        }

        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'diterima',
            'page'    => 'admin/peminjaman/v_diterima',
            'judul'   => 'Peminjaman Diterima',
            'peminjaman_grouped' => $peminjamanGrouped,
        ];
        return view('v_template_Admin', $data);
    }

    /**
     * Display all rejected peminjaman (ditolak)
     */
    public function ditolak()
    {
        $db = \Config\Database::connect();
        // fetch ditolak and group by anggota
        $peminjamanList = $db->table('tbl_peminjaman')
                        ->select('tbl_peminjaman.*, tbl_buku.judul_buku, tbl_buku.cover, tbl_anggota.nama_anggota, tbl_anggota.nim')
                        ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku')
                        ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
                        ->where('tbl_peminjaman.status', 'ditolak')
                        ->orderBy('tbl_peminjaman.id_anggota', 'ASC')
                        ->orderBy('tbl_peminjaman.id_peminjaman', 'DESC')
                        ->get()->getResultArray();

        $peminjamanGrouped = [];
        foreach ($peminjamanList as $p) {
            $id_anggota = $p['id_anggota'];
            if (!isset($peminjamanGrouped[$id_anggota])) {
                $peminjamanGrouped[$id_anggota] = [
                    'anggota_info' => [
                        'id_anggota' => $p['id_anggota'],
                        'nim' => $p['nim'],
                        'nama_anggota' => $p['nama_anggota'],
                    ],
                    'peminjaman' => []
                ];
            }
            $peminjamanGrouped[$id_anggota]['peminjaman'][] = $p;
        }

        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'ditolak',
            'page'    => 'admin/peminjaman/v_ditolak',
            'judul'   => 'Pengajuan Ditolak',
            'peminjaman_grouped' => $peminjamanGrouped,
        ];
        return view('v_template_Admin', $data);
    }

    /**
     * Display all returned peminjaman (dikembalikan)
     */
    public function dikembalikan()
    {
        $db = \Config\Database::connect();
        
        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'dikembalikan',
            'page'    => 'admin/peminjaman/v_dikembalikan',
            'judul'   => 'Peminjaman Dikembalikan',
            'peminjaman' => $db->table('tbl_peminjaman')
                            ->select('tbl_peminjaman.*, tbl_buku.judul_buku, tbl_buku.cover, tbl_anggota.nama_anggota, tbl_anggota.nim')
                            ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku')
                            ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
                            ->where('tbl_peminjaman.status', 'dikembalikan')
                            ->orderBy('tbl_peminjaman.id_peminjaman', 'DESC')
                            ->get()->getResultArray(),
        ];
        return view('v_template_Admin', $data);
    }
}
