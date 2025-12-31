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
              <?php echo form_open_multipart('admin/pengaturan/updateweb') ?>

               <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nama Web</label>
                    <input type="text" name="nama_web" value="<?= $web['nama_web'] ?? '' ?>" placeholder="Nama Web" class="form-control <?= isset(session('errors')['nama_web']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['nama_web'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="<?= $web['alamat'] ?? '' ?>" placeholder="Alamat" class="form-control <?= isset(session('errors')['alamat']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['alamat'] ?? '' ?>
                    </div>
                  </div>                        
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Kecamatan</label>
                    <input type="text" name="kecamatan" value="<?= $web['kecamatan'] ?? '' ?>" placeholder="Kecamatan" class="form-control <?= isset(session('errors')['kecamatan']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['kecamatan'] ?? '' ?>
                    </div>
                  </div>                        
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Kabupaten/Kota</label>
                    <input type="text" name="kab_kota" value="<?= $web['kab_kota'] ?? '' ?>" placeholder="Kabupaten/Kota" class="form-control <?= isset(session('errors')['kab_kota']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['kab_kota'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="no_telp" value="<?= $web['no_telp'] ?? '' ?>" placeholder="Nomor Telepon" class="form-control <?= isset(session('errors')['no_telp']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['no_telp'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" name="kode_pos" value="<?= $web['kode_pos'] ?? '' ?>" placeholder="Kode Pos" class="form-control <?= isset(session('errors')['kode_pos']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['kode_pos'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="form-group">
                        <label>Logo</label>
                        <div>
                        <img type="image" src="<?= base_url('uploads/web/'. ($web['logo'] ?? '')) ?>" width="250px">
                        </div>
                        <label> Ganti Logo</label>
                        <input type="file" name="logo" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti logo.</small>
                    </div>
                    
                    </div>
                  </div>    
                </div>         
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('admin/user') ?>"class="btn btn-success btn-flat">Kembali</a>

              <?php echo form_close() ?>

        </div>
    </div>
</div>