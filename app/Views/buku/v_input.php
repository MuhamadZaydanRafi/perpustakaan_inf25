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
      <?php echo form_open_multipart('admin/buku/insertdata') ?>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Kode Buku</label>
            <input name="kode_buku" value="<?= old('kode_buku') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('kode_buku') ? $validation->getError('kode_buku') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Judul Buku</label>
            <input name="judul_buku" value="<?= old('judul_buku') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('judul_buku') ? $validation->getError('judul_buku') : '' ?></p>
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
            <label>Rak</label>
            <select name="id_rak" class="form-control">
              <option value="">-- Pilih Rak --</option>
              <?php foreach($rak as $r): ?>
                <option value="<?= $r['id_rak'] ?>" <?= old('id_rak') == $r['id_rak'] ? 'selected' : '' ?>>
                  <?= $r['nama_rak'] ?>
                </option>
              <?php endforeach; ?>
            </select>
            <p class="text-danger"><?= $validation->hasError('id_rak') ? $validation->getError('id_rak') : '' ?></p>
          </div>
        </div>
      </div>

      <div class="row">
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
      </div>

      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label>Tahun</label>
            <input name="tahun" type="text" value="<?= old('tahun') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('tahun') ? $validation->getError('tahun') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>ISBN</label>
            <input name="isbn" value="<?= old('isbn') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('isbn') ? $validation->getError('isbn') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Halaman</label>
            <input name="halaman" type="text" value="<?= old('halaman') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('halaman') ? $validation->getError('halaman') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Jumlah</label>
            <input name="jumlah" type="text" value="<?= old('jumlah') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('jumlah') ? $validation->getError('jumlah') : '' ?></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Bahasa</label>
            <input name="bahasa" value="<?= old('bahasa') ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('bahasa') ? $validation->getError('bahasa') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Cover Buku</label>
            <input name="cover" type="file" class="form-control" accept="image/*">
            <p class="text-danger"><?= session()->getFlashdata('errors')['cover'] ?? '' ?></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Sinopsis</label>
            <textarea name="sinopsis" rows="4" class="form-control"><?= old('sinopsis') ?></textarea>
            <p class="text-danger"><?= $validation->hasError('sinopsis') ? $validation->getError('sinopsis') : '' ?></p>
            <p class="text-muted"><small>Deskripsi singkat tentang buku</small></p>
          </div>
        </div>
      </div>

      <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
      <a href="<?= base_url('admin/buku') ?>" class="btn btn-success btn-flat">Kembali</a>

      <?php echo form_close() ?>

    </div>
  </div>
</div>
