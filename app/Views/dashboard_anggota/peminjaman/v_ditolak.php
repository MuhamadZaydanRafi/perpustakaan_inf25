<div class="col-md-12">
    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>No Pinjam</th>
                    <th>Cover</th>
                    <th>Data Buku</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                foreach($peminjaman as $p): 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p['no_pinjam'] ?></td>
                    <td class="text-center">
                        <?php if($p['cover']): ?>
                            <img src="<?= base_url('uploads/cover/'. $p['cover']) ?>" alt="cover" style="max-height: 60px;">
                        <?php else: ?>
                            <span class="badge badge-warning">Tidak ada</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <b><?= $p['judul_buku'] ?></b><br>
                        <small class="text-muted">Lama Pinjam: <?= $p['lama_pinjam'] ?> hari</small>
                    </td>
                    <td><?= date('d-m-Y H:i', strtotime($p['tgl_pinjam'])) ?></td>
                    <td>
                        <span class="badge badge-danger">Ditolak</span>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    <!-- /.card -->
    </div>
</div>