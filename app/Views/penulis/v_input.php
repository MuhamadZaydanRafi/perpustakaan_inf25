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
              <?php echo form_open('admin/penulis/insertdata') ?>

                <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label>Penulis</label>
                        <input name="nama_penulis" value="<?= old('nama_penulis') ?>" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('nama_penulis') ? $validation->getError('nama_penulis') : '' ?></p>
                    </div>
                    </div>
                </div>   
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('admin/penulis') ?>"class="btn btn-success btn-flat">Kembali</a>
              <?php echo form_close() ?>

        </div>
    </div>
</div>
