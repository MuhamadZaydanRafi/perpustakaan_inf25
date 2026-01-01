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
              <?php echo form_open_multipart('admin/anggota/updatedata/'. ($anggota['id_anggota'] ?? '')) ?>

               <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" value="<?= old('nim') ?? ($anggota['nim'] ?? '') ?>" placeholder="NIM" class="form-control <?= isset(session('errors')['nim']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['nim'] ?? '' ?>
                    </div>
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Password</label>
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
                    <label>Nama Anggota</label>
                    <input type="text" name="nama_anggota" value="<?= old('nama_anggota') ?? ($anggota['nama_anggota'] ?? '') ?>" placeholder="Nama" class="form-control <?= isset(session('errors')['nama_anggota']) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= session('errors')['nama_anggota'] ?? '' ?>
                    </div>
                  </div>                        
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>No HP</label>
                    <input type="text" name="no_hp" value="<?= old('no_hp') ?? ($anggota['no_hp'] ?? '') ?>" placeholder="No Hp" class="form-control <?= isset(session('errors')['no_hp']) ? 'is-invalid' : '' ?>">
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
                    <select class="form-control <?= isset(session('errors')['id_kelas']) ? 'is-invalid' : '' ?>" name="id_kelas">
                      <option value="">--Pilih Kelas--</option>
                      <?php foreach ($kelas as $key => $value) { ?>
                        <option value="<?= $value['id_kelas'] ?>" <?= (old('id_kelas') ?? ($anggota['id_kelas'] ?? '')) == $value['id_kelas'] ? 'selected' : '' ?>><?= $value['nama_kelas'] ?></option>
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
                      <select class="form-control <?= isset(session('errors')['jenis_kelamin']) ? 'is-invalid' : '' ?>" name="jenis_kelamin">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki-Laki" <?= (old('jenis_kelamin') ?? ($anggota['jenis_kelamin'] ?? ''))=='Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= (old('jenis_kelamin') ?? ($anggota['jenis_kelamin'] ?? ''))=='Perempuan' ? 'selected' : '' ?>>Perempuan</option>
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
                      <label> Verifikasi</label>
                      <select class="form-control <?= isset(session('errors')['verifikasi']) ? 'is-invalid' : '' ?>" name="verifikasi">
                        <option value="0" <?= (old('verifikasi') ?? ($anggota['verifikasi'] ?? '0'))==='0' ? 'selected' : '' ?>>Belum Terverifikasi</option>
                        <option value="1" <?= (old('verifikasi') ?? ($anggota['verifikasi'] ?? '0'))==='1' ? 'selected' : '' ?>>Terverifikasi</option>
                      </select>
                      <div class="invalid-feedback">
                          <?= session('errors')['verifikasi'] ?? '' ?>
                      </div>
                    </div>
                  </div>        
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Alamat Anggota</label>
                        <textarea name="alamat" class="form-control <?= isset(session('errors')['alamat']) ? 'is-invalid' : '' ?>"><?= old('alamat') ?? ($anggota['alamat'] ?? '') ?></textarea>
                        <div class="invalid-feedback">
                            <?= session('errors')['alamat'] ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Foto</label>
                      <?php if (!empty($anggota['foto'])): ?>
                        <div><img src="<?= base_url('uploads/anggota/' . $anggota['foto']) ?>" width="150" class="img-thumbnail mb-2"></div>
                      <?php endif; ?>
                      <input name="foto" type="file" accept="image/*" class="form-control <?= isset(session('errors')['foto']) ? 'is-invalid' : '' ?>">
                      <div class="invalid-feedback">
                          <?= session('errors')['foto'] ?? '' ?>
                      </div>
                      <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                    </div>
                  </div>   
                </div>          
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('admin/anggota') ?>" class="btn btn-success btn-flat">Kembali</a>

              <?php echo form_close() ?>

        </div>
    </div>
</div>