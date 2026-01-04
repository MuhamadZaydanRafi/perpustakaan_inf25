<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-sm-12 text-center mb-4">
                    <?php if (!empty($anggota['foto']) && file_exists('uploads/anggota/' . $anggota['foto'])): ?>
                        <img src="<?= base_url('uploads/anggota/' . $anggota['foto']) ?>" 
                             width="200px" class="img-thumbnail">
                    <?php else: ?>
                        <img src="<?= base_url('AdminLTE/dist/img/avatar.png') ?>" width="200px" class="img-thumbnail">
                    <?php endif; ?>
                </div>

                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Anggota</th>
                            <th width="30px">:</th>
                            <td><?= esc($anggota['nama_anggota']) ?></td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <th>:</th>
                            <td><?= esc($anggota['nim']) ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <th>:</th>
                            <td><?= esc($anggota['nama_kelas'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <th>:</th>
                            <td><?= esc($anggota['jenis_kelamin']) ?></td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <th>:</th>
                            <td><?= esc($anggota['no_hp']) ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <td><?= nl2br(esc($anggota['alamat'])) ?></td>
                        </tr>
                        <tr>
                            <th>Verifikasi</th>
                            <th>:</th>
                            <td>
                                <?php if (isset($anggota['verifikasi']) && $anggota['verifikasi'] == 1): ?>
                                    <span class="text-success"><i class="fas fa-check"></i> Terverifikasi</span>
                                <?php else: ?>
                                    <span class="text-danger"><i class="fas fa-times"></i> Belum Terverifikasi</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>

                    <a href="<?= base_url('admin/anggota') ?>" class="btn btn-success btn-flat">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
