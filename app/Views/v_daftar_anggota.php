<div class="login-logo">
    <a href="<?= base_url() ?>"><b>Perpustakaan_inf25</b></a>
    <br> <h3><b>Informatika 25</h3>
  </div>
<div class="login-box">
  
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1">Login User</a>
    </div>
    <div class="card-body">
        <?php 
        //notifikasi
        $errors = session()->getflashdata('errors');
        if (!empty($errors)) { ?>
          <div class="alert alert-danger" role="alert">
          <h4>Periksa Entry Form</h4>
          <ul>
              <?php foreach ($errors as $key => $error) { ?>
                <li><?= esc($error) ?></li>
                <?php } ?>
              </ul>
          </div>
        <?php } ?>

        <?php
          if (session()->getFlashData('pesan')) {
            echo '<div class="alert alert-danger" role="alert">';
            echo session ()->getFlashData('pesan');
            echo '</div>';
          }

        ?>
      <?php echo form_open_multipart('anggota/insertdata') ?>
        <div class="form-group">
          <label> NIM</label>
          <input name="nim" class="form-control" placeholder="NIM">
        </div>
        <div class="form-group">
          <label>Nama anggota</label>
          <input name="nama_anggota" class="form-control" placeholder="Nama Anggota">
        </div>
        <div class="form-group">
          <label> Kelas</label>
          <select class="form-control" name="kelas" id="">
            <option value="">--Pilih Kelas--</option>
            <?php foreach ($kelas as $key => $value) { ?>
              <option value="<?= $value['id_kelas'] ?>"><?= $value['nama_kelas'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label> Jenis Kelamin</label>
          <select class="form-control" name="jenis_kelamin" id="">
            <option value="">--Pilih Jenis Kelamin--</option>
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label> No HP</label>
          <input name="no_hp" class="form-control" placeholder="No HP">
        </div>
        <div class="form-group">
          <label> Alamat</label>
          <input name="alamat" class="form-control" placeholder="Alamat">
        </div>
        <div class="form-group">
          <label> Foto</label>
          <input type="file" name="foto" class="form-control" placeholder="Foto">
        </div>

        <div class="row">
          <div class="col-sm-6">
            <a class="btn btn-success" href="<?= base_url('login') ?>">Kembali</a>
          </div>
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
        </div>
      <?php echo form_close() ?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
