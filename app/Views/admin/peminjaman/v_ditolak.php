<div class="col-md-12">
    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="accordion" id="peminjamanDitolakAccordion">
                <?php foreach($peminjaman_grouped as $id_anggota => $group): 
                    $anggota = $group['anggota_info'];
                    $totalPeminjaman = count($group['peminjaman']);
                    $idAccordion = 'ditolak-' . $id_anggota;
                ?>
                <div class="card mb-2">
                    <div class="card-header" id="heading-<?= $idAccordion ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#<?= $idAccordion ?>" aria-expanded="false" aria-controls="<?= $idAccordion ?>">
                                <i class="fas fa-chevron-down"></i>
                                <strong><?= $anggota['nim'] ?> - <?= $anggota['nama_anggota'] ?></strong>
                                <span class="badge badge-danger"><?= $totalPeminjaman ?> Ditolak</span>
                            </button>
                        </h2>
                    </div>

                    <div id="<?= $idAccordion ?>" class="collapse" aria-labelledby="heading-<?= $idAccordion ?>" data-parent="#peminjamanDitolakAccordion">
                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped table-sm mb-0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pinjam</th>
                                    <th>Cover</th>
                                    <th>Judul Buku</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Alasan Penolakan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; foreach($group['peminjaman'] as $p): ?>
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
                                    <td><?= date('d-m-Y H:i', strtotime($p['tgl_pinjam'])) ?></td>
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
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        
        </div>
    <!-- /.card -->
    </div>
</div>