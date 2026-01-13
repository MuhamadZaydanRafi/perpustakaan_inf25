<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Buku Perpustakaan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Cover</th>
                        <th>Detail Buku</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($buku as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center">
                            <?php if($value['cover']): ?>
                                <img src="<?= base_url('uploads/cover/'. $value['cover']) ?>" alt="cover" style="max-width: 200px; height: auto;">
                            <?php else: ?>
                                <span class="badge badge-warning">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <b><?= $value['judul_buku'] ?></b>
                            <p class="mb-2">
                                <small>
                                    <b>Kode:</b> <?= $value['kode_buku'] ?><br>
                                    <b>Penerbit:</b> <?= $value['nama_penerbit'] ?><br>
                                    <b>Penulis:</b> <?= $value['nama_penulis'] ?><br>
                                    <b>Kategori:</b> <?= $value['nama_kategori'] ?><br>
                                    <b>Rak:</b> <?= $value['nama_rak'] ?><br>
                                    <b>ISBN:</b> <?= $value['isbn'] ?><br>
                                    <b>Bahasa:</b> <?= $value['bahasa'] ?><br>
                                    <b>Sinopsis:</b> <?= substr($value['sinopsis'], 0, 100) . (strlen($value['sinopsis']) > 100 ? '...' : '') ?>
                                </small>
                            </p>
                            <a href="<?= base_url('anggota/buku/detail/'. $value['id_buku']) ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script>
    // Delay to ensure jQuery and DataTables are loaded
    setTimeout(function() {
        if (typeof $ !== 'undefined' && typeof $.fn.dataTable !== 'undefined') {
            $('#example1').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "searching": true,
                "paging": true,
                "ordering": true,
                "info": true,
            });
        }
    }, 500);
</script>
