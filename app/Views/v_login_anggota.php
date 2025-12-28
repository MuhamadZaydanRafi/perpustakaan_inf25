<div class="login-logo">
    <a href="<?= base_url() ?>"><b>Perpustakaan_inf25</b></a>
    <br> <h3><b>Informatika 25</h3>
  </div>
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url() ?>" class="h1">Login Anggota</a>
    </div>

    <div class="card-body">
      <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
          <input class="form-control" placeholder="NIM">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <a class="btn btn-success btn-block" href="<?= base_url('login') ?>">Kembali</a>
          </div>
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>
      <div class="social-auth-links text-center">
        <p>-Atau-</p>
        <a href="<?= base_url('daftar_anggota') ?>" class="btn btn-block btn-primary">
          <i class="fab fa-user-plus"></i> Daftar Anggota
        </a>
      </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
