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
              <?php echo form_open_multipart('admin/anggota/insertdata') ?>

               <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" value="<?= old('nim') ?>" placeholder="NIM" class="form-control <?= isset(session('errors')['nim']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['nim'] ?? '' ?>
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
                    <label>Nama Anggota</label>
                    <input type="text" name="nama_anggota" value="<?= old('nama_anggota') ?>" placeholder="Nama" class="form-control <?= isset(session('errors')['nama_anggota']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['nama_anggota'] ?? '' ?>
                    </div>
                  </div>                        
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>No Hp</label>
                    <input type="text" name="no_hp" value="<?= old('no_hp') ?>" placeholder="No Hp" class="form-control <?= isset(session('errors')['no_hp']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['no_hp'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label> Kelas</label>
                    <select class="form-control <?= isset(session('errors')['id_kelas']) ? 'is-invalid' : '' ?>" name="id_kelas" id="">
                      <option value="">--Pilih Kelas--</option>
                      <?php foreach ($kelas as $key => $value) { ?>
                        <option value="<?= $value['id_kelas'] ?>" <?= old('id_kelas') == $value['id_kelas'] ? 'selected' : '' ?>><?= $value['nama_kelas'] ?></option>
                      <?php } ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors')['id_kelas'] ?? '' ?>
                    </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label> Jenis Kelamin</label>
                      <select class="form-control <?= isset(session('errors')['jenis_kelamin']) ? 'is-invalid' : '' ?>" name="jenis_kelamin" id="">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki-Laki" <?= old('jenis_kelamin')=='Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= old('jenis_kelamin')=='Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                      </select>
                      <div class="invalid-feedback">
                          <?= session('errors')['jenis_kelamin'] ?? '' ?>
                      </div>
                    </div>
                  </div>
                </div>              
                <div class="row">   
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Alamat Anggota</label>
                        <textarea name="alamat" class="form-control <?= isset(session('errors')['alamat']) ? 'is-invalid' : '' ?>"><?= old('alamat') ?></textarea>
                        <div class="invalid-feedback">
                            <?= session('errors')['alamat'] ?? '' ?>
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