<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php if(isset($errors) && $errors): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Error!</h4>
                    <ul>
                        <?php foreach($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php echo form_open(base_url('anggota/peminjaman/updatedata/' . $peminjaman['id_peminjaman'])) ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nomor Pinjam</label>
                        <input type="text" name="nomor_pinjam" class="form-control" value="<?= $peminjaman['no_pinjam'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" value="<?= ucfirst($peminjaman['status']) ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Judul Buku <span class="text-danger">*</span></label>
                        <select name="id_buku" class="form-control select2" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach($buku as $b): ?>
                                <option value="<?= $b['id_buku'] ?>" <?= $b['id_buku'] == $peminjaman['id_buku'] ? 'selected' : '' ?>>
                                    <?= $b['judul_buku'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_pinjam" class="form-control" value="<?= $peminjaman['tgl_pinjam'] ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lama Pinjam (Hari) <span class="text-danger">*</span></label>
                        <input type="number" name="lama_pinjam" class="form-control" value="<?= $peminjaman['lama_pinjam'] ?>" max="7" min="1" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input type="date" class="form-control" value="<?= $peminjaman['tgl_kembali'] ?>" readonly>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="<?= base_url('anggota/peminjaman/pengajuan') ?>" class="btn btn-secondary btn-flat">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <?php echo form_close() ?>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });
    });
</script>