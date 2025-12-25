<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php 
              session();
              $validation = \Config\Services::validation();
              ?>
              <?php echo form_open('admin/rak/insertdata') ?>

                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Rak</label>
                        <input name="nama_rak" value="<?= old('nama_rak') ?>" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('nama_rak') ? $validation->getError('nama_rak') : '' ?></p>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label>Lantai Rak</label>
                        <input type="number" name="lantai_rak" value="<?= old('lantai_rak') ?>" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('lantai_rak') ? $validation->getError('lantai_rak') : '' ?></p>
                    </div>
                    </div>
                </div>   
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('admin/rak') ?>"class="btn btn-success btn-flat">Kembali</a>
              <?php echo form_close() ?>

        </div>
    </div>
</div>
