<?php

namespace App\Controllers\Anggota;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelAnggota;
use App\Models\ModelBuku;
use App\Models\ModelPeminjaman;

class Peminjaman extends BaseController
{
    protected $ModelAnggota;
    protected $ModelBuku;
    protected $ModelPeminjaman;

    public function __construct()
    {
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelBuku = new ModelBuku();
        $this->ModelPeminjaman = new ModelPeminjaman();
        helper('form');
    }

    public function index()
    {
        //
    }

    /**
     * Display peminjaman pengajuan list
     */
    public function pengajuan()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'pengajuan',
            'page'    => 'dashboard_anggota/peminjaman/v_pengajuan',
            'judul'   => 'Pengajuan Peminjaman',
            'buku'    => $this->ModelBuku->getBukuWithRelasi(),
            'peminjaman' => $this->ModelPeminjaman->getPeminjamanByAnggota($id_anggota),
        ];
        return view('v_template_anggota', $data);
    }

    /**
     * Insert new peminjaman pengajuan
     */
    public function insertdata()
    {
        $id_anggota = session()->get('id_anggota');
        $no_pinjam = $this->request->getPost('nomor_pinjam');
        $id_buku = $this->request->getPost('id_buku');
        $tgl_pinjam = $this->request->getPost('tgl_pinjam');
        $lama_pinjam = $this->request->getPost('lama_pinjam');

        // Hitung tanggal kembali
        $tgl_kembali = date('Y-m-d', strtotime($tgl_pinjam . ' + ' . $lama_pinjam . ' days'));

        $data = [
            'no_pinjam'   => $no_pinjam,
            'id_anggota'  => $id_anggota,
            'id_buku'     => $id_buku,
            'tgl_pinjam'  => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'lama_pinjam' => $lama_pinjam,
            'status'      => 'pengajuan',
        ];

        if (!$this->ModelPeminjaman->insert($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPeminjaman->errors());
        }

        session()->setFlashdata('success', 'Pengajuan peminjaman berhasil dibuat.');
        return redirect()->to('anggota/peminjaman/pengajuan');
    }

    /**
     * Display edit form for peminjaman
     */
    public function edit($id_peminjaman)
    {
        $id_anggota = session()->get('id_anggota');
        $peminjaman = $this->ModelPeminjaman->find($id_peminjaman);

        if (!$peminjaman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data peminjaman tidak ditemukan');
        }

        // Pastikan anggota hanya bisa edit peminjaman miliknya sendiri
        if ($peminjaman['id_anggota'] != $id_anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses ke data ini');
        }

        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'pengajuan',
            'page'    => 'dashboard_anggota/peminjaman/v_edit',
            'judul'   => 'Edit Pengajuan Peminjaman',
            'peminjaman' => $peminjaman,
            'buku'    => $this->ModelBuku->getBukuWithRelasi(),
        ];
        return view('v_template_anggota', $data);
    }

    /**
     * Update peminjaman data
     */
    public function updatedata($id_peminjaman)
    {
        $id_anggota = session()->get('id_anggota');
        $peminjaman = $this->ModelPeminjaman->find($id_peminjaman);

        if (!$peminjaman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data peminjaman tidak ditemukan');
        }

        // Pastikan anggota hanya bisa update peminjaman miliknya sendiri
        if ($peminjaman['id_anggota'] != $id_anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses ke data ini');
        }

        // Hanya allow edit jika status masih pengajuan
        if ($peminjaman['status'] != 'pengajuan') {
            return redirect()->back()
                ->with('errors', ['Pengajuan yang sudah ' . $peminjaman['status'] . ' tidak bisa diubah.']);
        }

        $tgl_pinjam = $this->request->getPost('tgl_pinjam');
        $lama_pinjam = $this->request->getPost('lama_pinjam');
        $tgl_kembali = date('Y-m-d', strtotime($tgl_pinjam . ' + ' . $lama_pinjam . ' days'));

        $data = [
            'id_buku'     => $this->request->getPost('id_buku'),
            'tgl_pinjam'  => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'lama_pinjam' => $lama_pinjam,
        ];

        if (!$this->ModelPeminjaman->update($id_peminjaman, $data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->ModelPeminjaman->errors());
        }

        session()->setFlashdata('success', 'Pengajuan peminjaman berhasil diubah.');
        return redirect()->to('anggota/peminjaman/pengajuan');
    }

    /**
     * Delete peminjaman (hanya bisa delete jika status pengajuan)
     */
    public function deletedata($id_peminjaman)
    {
        $id_anggota = session()->get('id_anggota');
        $peminjaman = $this->ModelPeminjaman->find($id_peminjaman);

        if (!$peminjaman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data peminjaman tidak ditemukan');
        }

        // Pastikan anggota hanya bisa delete peminjaman miliknya sendiri
        if ($peminjaman['id_anggota'] != $id_anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses ke data ini');
        }

        // Hanya allow delete jika status masih pengajuan
        if ($peminjaman['status'] != 'pengajuan') {
            return redirect()->back()
                ->with('errors', ['Pengajuan yang sudah ' . $peminjaman['status'] . ' tidak bisa dihapus.']);
        }

        if (!$this->ModelPeminjaman->delete($id_peminjaman)) {
            return redirect()->back()
                ->with('errors', $this->ModelPeminjaman->errors());
        }

        session()->setFlashdata('success', 'Pengajuan peminjaman berhasil dihapus.');
        return redirect()->to('anggota/peminjaman/pengajuan');
    }

    /**
     * Display peminjaman diterima
     */
    public function diterima()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'diterima',
            'page'    => 'dashboard_anggota/peminjaman/v_diterima',
            'judul'   => 'Peminjaman Diterima',
            'peminjaman' => $this->ModelPeminjaman->getPeminjamanByStatus($id_anggota, 'diterima'),
        ];
        return view('v_template_anggota', $data);
    }

    /**
     * Display peminjaman ditolak
     */
    public function ditolak()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'ditolak',
            'page'    => 'dashboard_anggota/peminjaman/v_ditolak',
            'judul'   => 'Pengajuan Ditolak',
            'peminjaman' => $this->ModelPeminjaman->getPeminjamanByStatus($id_anggota, 'ditolak'),
        ];
        return view('v_template_anggota', $data);
    }

    /**
     * Display peminjaman history
     */
    public function history()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu'    => 'peminjaman',
            'submenu' => 'history',
            'page'    => 'dashboard_anggota/peminjaman/v_history',
            'judul'   => 'History Peminjaman',
            'peminjaman' => $this->ModelPeminjaman->getPeminjamanByAnggota($id_anggota),
        ];
        return view('v_template_anggota', $data);
    }
}
