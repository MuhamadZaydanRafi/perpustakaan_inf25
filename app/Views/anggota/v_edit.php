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
              <?php echo form_open_multipart('admin/user/update/'. $users['id_user']) ?>

               <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?= $users['email'] ?>" placeholder="email" class="form-control <?= isset(session('errors')['email']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['email'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>password</label>
                    <input type="password" name="password"
                        placeholder="Kosongkan jika tidak ingin mengganti password"
                        class="form-control <?= isset(session('errors')['password']) ? 'is-invalid' : '' ?>">
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
                    <input type="text" name="nama_user" value="<?= $users['nama_user'] ?>" placeholder="Nama" class="form-control <?= isset(session('errors')['nama_user']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['nama_user'] ?? '' ?>
                    </div>
                  </div>                        
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>role</label>
                    <input type="text" name="role" value="<?= $users['role'] ?>" placeholder="role" class="form-control <?= isset(session('errors')['role']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['role'] ?? '' ?>
                    </div>
                  </div>
                  </div>  
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="form-group">
                        <label>Foto</label>
                        <div>
                        <img type="image" src="<?= base_url('uploads/user/'. $users['foto']) ?>" width="250px">
                        </div>
                        <input type="file" name="foto" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
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