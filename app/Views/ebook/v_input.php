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
      <?php echo form_open_multipart('admin/ebook/insertdata') ?>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Judul E-Book</label>
            <input name="judul_ebook" value="<?= old('judul_ebook') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('judul_ebook') ? $validation->getError('judul_ebook') : '' ?></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control">
              <option value="">-- Pilih Kategori --</option>
              <?php foreach($kategori as $kat): ?>
                <option value="<?= $kat['id_kategori'] ?>" <?= old('id_kategori') == $kat['id_kategori'] ? 'selected' : '' ?>>
                  <?= $kat['nama_kategori'] ?>
                </option>
              <?php endforeach; ?>
            </select>
            <p class="text-danger"><?= $validation->hasError('id_kategori') ? $validation->getError('id_kategori') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Penerbit</label>
            <select name="id_penerbit" class="form-control">
              <option value="">-- Pilih Penerbit --</option>
              <?php foreach($penerbit as $p): ?>
                <option value="<?= $p['id_penerbit'] ?>" <?= old('id_penerbit') == $p['id_penerbit'] ? 'selected' : '' ?>>
                  <?= $p['nama_penerbit'] ?>
                </option>
              <?php endforeach; ?>
            </select>
            <p class="text-danger"><?= $validation->hasError('id_penerbit') ? $validation->getError('id_penerbit') : '' ?></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Penulis</label>
            <select name="id_penulis" class="form-control">
              <option value="">-- Pilih Penulis --</option>
              <?php foreach($penulis as $pen): ?>
                <option value="<?= $pen['id_penulis'] ?>" <?= old('id_penulis') == $pen['id_penulis'] ? 'selected' : '' ?>>
                  <?= $pen['nama_penulis'] ?>
                </option>
              <?php endforeach; ?>
            </select>
            <p class="text-danger"><?= $validation->hasError('id_penulis') ? $validation->getError('id_penulis') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Tahun</label>
            <input name="tahun" type="number" value="<?= old('tahun') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('tahun') ? $validation->getError('tahun') : '' ?></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ISBN</label>
            <input name="isbn" value="<?= old('isbn') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('isbn') ? $validation->getError('isbn') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Bahasa</label>
            <input name="bahasa" value="<?= old('bahasa') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('bahasa') ? $validation->getError('bahasa') : '' ?></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Sinopsis</label>
            <textarea name="sinopsis" rows="4" class="form-control"><?= old('sinopsis') ?></textarea>
            <p class="text-danger"><?= $validation->hasError('sinopsis') ? $validation->getError('sinopsis') : '' ?></p>
            <p class="text-muted"><small>Deskripsi singkat tentang e-book</small></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Cover E-Book</label>
            <input name="cover" type="file" class="form-control" accept="image/*">
            <p class="text-danger"><?= session()->getFlashdata('errors')['cover'] ?? '' ?></p>
            <p class="text-muted"><small>Format: JPG/PNG, Max 2MB</small></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>File E-Book (PDF)</label>
            <input name="file_ebook" type="file" class="form-control" accept=".pdf">
            <p class="text-danger"><?= session()->getFlashdata('errors')['file_ebook'] ?? '' ?></p>
            <p class="text-muted"><small>Format: PDF, Max 10MB</small></p>
          </div>
        </div>
      </div>

      <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
      <a href="<?= base_url('admin/ebook') ?>" class="btn btn-success btn-flat">Kembali</a>

      <?php echo form_close() ?>

    </div>
  </div>
</div>
