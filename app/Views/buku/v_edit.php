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
      <?php echo form_open_multipart('admin/buku/updatedata/'. $buku['id_buku']) ?>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Kode Buku</label>
            <input name="kode_buku" value="<?= $buku['kode_buku'] ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('kode_buku') ? $validation->getError('kode_buku') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Judul Buku</label>
            <input name="judul_buku" value="<?= $buku['judul_buku'] ?>" class="form-control">
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
                <option value="<?= $kat['id_kategori'] ?>" <?= $buku['id_kategori'] == $kat['id_kategori'] ? 'selected' : '' ?>>
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
                <option value="<?= $r['id_rak'] ?>" <?= $buku['id_rak'] == $r['id_rak'] ? 'selected' : '' ?>>
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
                <option value="<?= $p['id_penerbit'] ?>" <?= $buku['id_penerbit'] == $p['id_penerbit'] ? 'selected' : '' ?>>
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
                <option value="<?= $pen['id_penulis'] ?>" <?= $buku['id_penulis'] == $pen['id_penulis'] ? 'selected' : '' ?>>
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
            <input name="tahun" type="number" value="<?= $buku['tahun'] ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('tahun') ? $validation->getError('tahun') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>ISBN</label>
            <input name="isbn" value="<?= $buku['isbn'] ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('isbn') ? $validation->getError('isbn') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Halaman</label>
            <input name="halaman" type="number" value="<?= $buku['halaman'] ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('halaman') ? $validation->getError('halaman') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Jumlah</label>
            <input name="jumlah" type="number" value="<?= $buku['jumlah'] ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('jumlah') ? $validation->getError('jumlah') : '' ?></p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Bahasa</label>
            <input name="bahasa" value="<?= $buku['bahasa'] ?>" class="form-control">
            <p class="text-danger"><?= $validation->hasError('bahasa') ? $validation->getError('bahasa') : '' ?></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Cover Buku</label>
            <input name="cover" type="file" class="form-control" accept="image/*">
            <p class="text-danger"><?= session()->getFlashdata('errors')['cover'] ?? '' ?></p>
            <?php if($buku['cover']): ?>
              <div class="mt-2">
                <p class="text-muted">Cover saat ini:</p>
                <img src="<?= base_url('uploads/cover/'. $buku['cover']) ?>" alt="cover" style="max-width: 150px; height: auto;">
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Sinopsis</label>
            <textarea name="sinopsis" rows="4" class="form-control"><?= $buku['sinopsis'] ?></textarea>
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
