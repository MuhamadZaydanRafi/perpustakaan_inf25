<div class="col-md-12">
    <div class="card card-outline card-info">
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
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                foreach($peminjaman as $p): 
                    $status_badge = '';
                    if($p['status'] == 'pengajuan') {
                        $status_badge = '<span class="badge badge-warning">Pengajuan</span>';
                    } elseif($p['status'] == 'diterima') {
                        $status_badge = '<span class="badge badge-success">Diterima</span>';
                    } elseif($p['status'] == 'ditolak') {
                        $status_badge = '<span class="badge badge-danger">Ditolak</span>';
                    } elseif($p['status'] == 'dikembalikan') {
                        $status_badge = '<span class="badge badge-info">Dikembalikan</span>';
                    }
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
                    <td><?= date('d-m-Y', strtotime($p['tgl_pinjam'])) ?></td>
                    <td><?= date('d-m-Y', strtotime($p['tgl_kembali'])) ?></td>
                    <td><?= $status_badge ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    <!-- /.card -->
    </div>
</div>