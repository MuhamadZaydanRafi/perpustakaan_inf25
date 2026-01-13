<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
        <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Cover</th>
                        <th>Judul Buku</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($buku as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="text-center">
                            <?php if($value['cover']): ?>
                                <img src="<?= base_url('uploads/cover/'. $value['cover']) ?>" alt="cover" style="max-width: 200px; height: auto;">
                            <?php else: ?>
                                <span class="badge badge-warning">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td><b><?= $value['judul_buku'] ?></b>
                        <p>
                            <b>Penerbit:</b> <?= $value['nama_penerbit'] ?><br>
                            <b>Penulis:</b> <?= $value['nama_penulis'] ?><br>
                            <b>Kategori:</b> <?= $value['nama_kategori'] ?><br>
                            <b>Rak:</b> <?= $value['nama_rak'] ?><br>
                            <b>ISBN:</b> <?= $value['isbn'] ?><br>
                            <b>Bahasa:</b> <?= $value['bahasa'] ?><br>
                            <b>Sinopsis:</b> <?= substr($value['sinopsis'], 0, 100) . (strlen($value['sinopsis']) > 100 ? '...' : '') ?>
                        </p>
                        <a href="<?= base_url('detailbuku/'. $value['id_buku']) ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <!-- /.card -->
    </div>
</div>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "searching": true,
            "paging": true,
            "ordering": true,
            "info": true,
        });
    });
</script>
