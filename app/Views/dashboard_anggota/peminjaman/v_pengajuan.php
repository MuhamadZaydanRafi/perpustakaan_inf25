<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
        <h2 class="card-title"><?= $judul ?></h2>
        <div class="card-tools">
        <button class="btn btn-flat btn-primary btn-sm " data-toggle="modal" data-target="#modal-sm">
          <i class="fas fa-plus"></i> Tambah
        </button>
      </div>
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
                    <th>Aksi</th>
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
                        <small class="text-muted">Tgl Pinjam: <?= date('d-m-Y', strtotime($p['tgl_pinjam'])) ?></small><br>
                        <small class="text-muted">Tgl Kembali: <?= date('d-m-Y', strtotime($p['tgl_kembali'])) ?></small>
                    </td>
                    <td><?= date('d-m-Y H:i', strtotime($p['tgl_pinjam'])) ?></td>
                    <td><?= $status_badge ?></td>
                    <td>
                        <?php if($p['status'] == 'pengajuan'): ?>
                            <a href="<?= base_url('anggota/peminjaman/edit/'. $p['id_peminjaman']) ?>" class="btn btn-xs btn-warning btn-flat">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('anggota/peminjaman/deletedata/'. $p['id_peminjaman']) ?>" class="btn btn-xs btn-danger btn-flat" onclick="return confirm('Yakin ingin menghapus?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        <?php else: ?>
                            <button class="btn btn-xs btn-secondary btn-flat" disabled>
                                <i class="fas fa-lock"></i>
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    <!-- /.card -->
    </div>
</div>

<!-- Modal tambah pengajuan -->
<div class="modal fade" id="modal-sm">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <?php 
                $id_anggota = session()->get('id_anggota');
                $tgl = date('YmdHis');
                $no_pinjam = $id_anggota . $tgl;
                ?>
                <?php echo form_open(base_url('anggota/peminjaman/insertdata')) ?>
                <div class="form-group">
                    <label>Nomor Pinjam</label>
                    <input type="text" name="nomor_pinjam" class="form-control" placeholder="Nomor Pinjam" value="<?= $no_pinjam ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Judul Buku</label>
                    <select name="id_buku" class="form-control select2" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach($buku as $b): ?>
                            <option value="<?= $b['id_buku'] ?>"><?= $b['judul_buku'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" class="form-control" placeholder="Tanggal Pinjam" required>
                </div>
                <div class="form-group">
                    <label>Lama Pinjam (Hari)</label>
                    <input type="number" name="lama_pinjam" value="7" max="7" min="1" class="form-control" placeholder="Lama Pinjam" required>
                </div>

            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary btn-flat">
                    Simpan
                </button>
            </div>

            <?php echo form_close() ?>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    // Initialize Select2 when modal is shown
    $('#modal-sm').on('shown.bs.modal', function () {
        $('.select2').select2({
            width: '100%'
        });
    });

    // Alternative: Initialize Select2 with delay to ensure DOM ready
    setTimeout(function() {
        $('.select2').select2({
            width: '100%'
        });
    }, 500);
</script>