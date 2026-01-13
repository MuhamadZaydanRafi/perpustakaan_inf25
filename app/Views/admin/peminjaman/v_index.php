<div class="col-md-12">
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Accordion for grouped peminjaman by anggota -->
            <div class="accordion" id="peminjamanAccordion">
                <?php $groupNo = 1;
                foreach($peminjaman_grouped as $id_anggota => $group): 
                    $anggota = $group['anggota_info'];
                    $totalPeminjaman = count($group['peminjaman']);
                    $idAccordion = 'accordion-' . $id_anggota;
                ?>
                
                <div class="card mb-2">
                    <div class="card-header" id="heading-<?= $idAccordion ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#<?= $idAccordion ?>" aria-expanded="false" aria-controls="<?= $idAccordion ?>">
                                <i class="fas fa-chevron-down"></i>
                                <strong><?= $anggota['nim'] ?> - <?= $anggota['nama_anggota'] ?></strong>
                                <span class="badge badge-warning"><?= $totalPeminjaman ?> Pengajuan</span>
                            </button>
                        </h2>
                    </div>

                    <div id="<?= $idAccordion ?>" class="collapse" aria-labelledby="heading-<?= $idAccordion ?>" data-parent="#peminjamanAccordion">
                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped table-sm mb-0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pinjam</th>
                                    <th>Cover</th>
                                    <th>Judul Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;
                                foreach($group['peminjaman'] as $p): 
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $p['no_pinjam'] ?></td>
                                    <td class="text-center">
                                        <?php if($p['cover']): ?>
                                            <img src="<?= base_url('uploads/cover/'. $p['cover']) ?>" alt="cover" style="max-height: 50px;">
                                        <?php else: ?>
                                            <span class="badge badge-warning">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $p['judul_buku'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($p['tgl_pinjam'])) ?></td>
                                    <td><?= date('d-m-Y', strtotime($p['tgl_kembali'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/peminjaman/detail/'. $p['id_peminjaman']) ?>" class="btn btn-xs btn-info btn-flat">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="<?= base_url('admin/peminjaman/setuju/'. $p['id_peminjaman']) ?>" class="btn btn-xs btn-success btn-flat" onclick="return confirm('Setujui peminjaman ini?');">
                                            <i class="fas fa-check"></i> Setuju
                                        </a>
                                        <a href="<?= base_url('admin/peminjaman/tolak/'. $p['id_peminjaman']) ?>" class="btn btn-xs btn-danger btn-flat" onclick="return confirm('Tolak peminjaman ini?');">
                                            <i class="fas fa-times"></i> Tolak
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
            
        </div>
    <!-- /.card -->
    </div>
</div>

<!-- Modal Setuju -->
<div class="modal fade" id="modal-setuju">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setujui Peminjaman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-setuju" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" id="id_peminjaman_setuju" name="id_peminjaman" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="4" placeholder="Masukkan keterangan atau catatan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-flat">Setujui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="modal-tolak">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tolak Peminjaman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-tolak" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" id="id_peminjaman_tolak" name="id_peminjaman" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Keterangan Penolakan</label>
                        <textarea name="keterangan" class="form-control" rows="4" placeholder="Masukkan alasan penolakan..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-flat">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Handle Setuju Modal
    $('#modal-setuju').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id_peminjaman = button.data('id');
        console.log('Setuju ID:', id_peminjaman);
        $('#id_peminjaman_setuju').val(id_peminjaman);
        $('#form-setuju')[0].reset();
        // Reset hidden input after reset
        $('#id_peminjaman_setuju').val(id_peminjaman);
    });

    // Handle Tolak Modal
    $('#modal-tolak').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id_peminjaman = button.data('id');
        console.log('Tolak ID:', id_peminjaman);
        $('#id_peminjaman_tolak').val(id_peminjaman);
        $('#form-tolak')[0].reset();
        // Reset hidden input after reset
        $('#id_peminjaman_tolak').val(id_peminjaman);
    });

    // Form submit handlers
    $('#form-setuju').on('submit', function(e) {
        var id_peminjaman = $('#id_peminjaman_setuju').val();
        var baseUrl = '<?= base_url() ?>';
        var action = baseUrl + 'admin/peminjaman/setuju/' + id_peminjaman;
        console.log('Form setuju submitting to:', action);
        $(this).attr('action', action);
    });

    $('#form-tolak').on('submit', function(e) {
        var id_peminjaman = $('#id_peminjaman_tolak').val();
        var baseUrl = '<?= base_url() ?>';
        var action = baseUrl + 'admin/peminjaman/tolak/' + id_peminjaman;
        console.log('Form tolak submitting to:', action);
        $(this).attr('action', action);
    });
});
</script>