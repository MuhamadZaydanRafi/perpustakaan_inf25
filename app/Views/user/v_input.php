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
              <?php echo form_open_multipart('admin/user/insertdata') ?>

               <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?= old('email') ?>" placeholder="email" class="form-control <?= isset(session('errors')['email']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['email'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>password</label>
                    <input type="text" name="password" value="<?= old('password') ?>" placeholder="password" class="form-control <?= isset(session('errors')['password']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['password'] ?? '' ?>
                    </div>
                  </div>                        
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" name="nama_user" value="<?= old('nama_user') ?>" placeholder="Nama" class="form-control <?= isset(session('errors')['nama_user']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['nama_user'] ?? '' ?>
                    </div>
                  </div>                        
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>role</label>
                    <input type="text" name="role" value="<?= old('role') ?>" placeholder="role" class="form-control <?= isset(session('errors')['role']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['role'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input name="foto" type="file" accept="image/*" class="form-control <?= isset(session('errors')['foto']) ? 'is-invalid' : '' ?>" placeholder="masukan foto">
                      <div class="invalid-feedback">
                          <?= session('errors')['foto'] ?? '' ?>
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