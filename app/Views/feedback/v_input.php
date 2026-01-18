<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php 
            session();
            $validation = \Config\Services::validation();
            ?>
            <?php echo form_open('admin/feedback/insertdata') ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" value="<?= old('nama') ?>" class="form-control" required>
                        <p class="text-danger"><?= $validation->hasError('nama') ? $validation->getError('nama') : '' ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Komentar</label>
                        <textarea name="komentar" class="form-control" rows="3" required><?= old('komentar') ?></textarea>
                        <p class="text-danger"><?= $validation->hasError('komentar') ? $validation->getError('komentar') : '' ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Keluhan</label>
                        <textarea name="keluhan" class="form-control" rows="3" required><?= old('keluhan') ?></textarea>
                        <p class="text-danger"><?= $validation->hasError('keluhan') ? $validation->getError('keluhan') : '' ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Penilaian</label>
                        <select name="penilaian" class="form-control" required>
                            <option value="">-- Pilih Penilaian --</option>
                            <option value="Sangat Baik" <?= old('penilaian') == 'Sangat Baik' ? 'selected' : '' ?>>Sangat Baik</option>
                            <option value="Baik" <?= old('penilaian') == 'Baik' ? 'selected' : '' ?>>Baik</option>
                            <option value="Cukup" <?= old('penilaian') == 'Cukup' ? 'selected' : '' ?>>Cukup</option>
                            <option value="Kurang" <?= old('penilaian') == 'Kurang' ? 'selected' : '' ?>>Kurang</option>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('penilaian') ? $validation->getError('penilaian') : '' ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Saran</label>
                        <textarea name="saran" class="form-control" rows="3" required><?= old('saran') ?></textarea>
                        <p class="text-danger"><?= $validation->hasError('saran') ? $validation->getError('saran') : '' ?></p>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('admin/feedback') ?>" class="btn btn-success btn-flat">Kembali</a>
            <?php echo form_close() ?>

        </div>
    </div>
</div>
