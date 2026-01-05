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
              <?php echo form_open_multipart('admin/slider/insertslider') ?>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="form-group">
                        <label>Slider</label>
                        <input type="file" name="slider" class="form-control">
                    </div>
                    
                    </div>
                  </div>    
                </div>         
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('admin/slider') ?>"class="btn btn-success btn-flat">Kembali</a>

              <?php echo form_close() ?>

        </div>
    </div>
</div>