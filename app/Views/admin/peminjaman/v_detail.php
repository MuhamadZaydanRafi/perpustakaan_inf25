<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <?php if($peminjaman['cover']): ?>
                        <img src="<?= base_url('uploads/cover/'. $peminjaman['cover']) ?>" alt="cover" style="max-width: 250px; height: auto;">
                    <?php else: ?>
                        <div class="alert alert-warning">Tidak ada cover</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="150"><strong>No Pinjam</strong></td>
                                <td>:</td>
                                <td><?= $peminjaman['no_pinjam'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>:</td>
                                <td><span class="badge badge-warning">Pengajuan</span></td>
                            </tr>
                            <tr>
                                <td><strong>NIS Anggota</strong></td>
                                <td>:</td>
                                <td><?= $peminjaman['nim'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nama Anggota</strong></td>
                                <td>:</td>
                                <td><?= $peminjaman['nama_anggota'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Judul Buku</strong></td>
                                <td>:</td>
                                <td><b><?= $peminjaman['judul_buku'] ?></b></td>
                            </tr>
                            <tr>
                                <td><strong>ISBN</strong></td>
                                <td>:</td>
                                <td><?= $peminjaman['isbn'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tahun</strong></td>
                                <td>:</td>
                                <td><?= $peminjaman['tahun'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Pinjam</strong></td>
                                <td>:</td>
                                <td><?= date('d-m-Y', strtotime($peminjaman['tgl_pinjam'])) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Kembali</strong></td>
                                <td>:</td>
                                <td><?= date('d-m-Y', strtotime($peminjaman['tgl_kembali'])) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Lama Pinjam</strong></td>
                                <td>:</td>
                                <td><?= $peminjaman['lama_pinjam'] ?> hari</td>
                            </tr>
                            <?php if(!empty($peminjaman['keterangan'])): ?>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td>:</td>
                                <td><?= $peminjaman['keterangan'] ?></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <a href="<?= base_url('admin/peminjaman/setuju/'. $peminjaman['id_peminjaman']) ?>" class="btn btn-success btn-flat" onclick="return confirm('Setujui peminjaman ini?');">
                    <i class="fas fa-check"></i> Setujui Peminjaman
                </a>
                <a href="<?= base_url('admin/peminjaman/tolak/'. $peminjaman['id_peminjaman']) ?>" class="btn btn-danger btn-flat" onclick="return confirm('Tolak peminjaman ini?');">
                    <i class="fas fa-times"></i> Tolak Peminjaman
                </a>
                <a href="<?= base_url('admin/peminjaman') ?>" class="btn btn-secondary btn-flat">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>