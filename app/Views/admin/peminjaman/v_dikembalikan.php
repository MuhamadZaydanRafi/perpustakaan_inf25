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
                    <th>NIS Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Tgl Pengembalian</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                foreach($peminjaman as $p): 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $p['no_pinjam'] ?></td>
                    <td><?= $p['nim'] ?></td>
                    <td><?= $p['nama_anggota'] ?></td>
                    <td><?= $p['judul_buku'] ?></td>
                    <td><?= date('d-m-Y', strtotime($p['tgl_pinjam'])) ?></td>
                    <td><?= date('d-m-Y', strtotime($p['tgl_kembali'])) ?></td>
                    <td><?= $p['tgl_pengembalian'] ? date('d-m-Y', strtotime($p['tgl_pengembalian'])) : '-' ?></td>
                    <td><?= !empty($p['keterangan']) ? $p['keterangan'] : '<span class="text-muted">-</span>' ?></td>
                    <td>
                        <a href="<?= base_url('admin/peminjaman/detail/'. $p['id_peminjaman']) ?>" class="btn btn-xs btn-info btn-flat">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    <!-- /.card -->
    </div>
</div>