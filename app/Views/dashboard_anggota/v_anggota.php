<div class="col-md-12">
  <div class="card card-primary card-outline">
    <div class="card-body">
      <div class="row">
        <!-- Foto Profil di Kiri -->
        <div class="col-md-4 text-center">
          <?php $foto = session()->get('foto') ? session()->get('foto') : 'default.png'; ?>
          <img src="<?= base_url('uploads/anggota/' . $foto) ?>" 
              class="img-fluid rounded" alt="Foto Anggota" style="max-height: 300px; border: 3px solid #000000;">
        </div>

        <!-- Data Profil di Kanan -->
        <div class="col-md-8">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4><strong>Data Profile Anggota</strong></h4>
            <a href="<?= base_url('anggota/edit_profil/' . session()->get('id_anggota')) ?>" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i> Edit Profile
            </a>
          </div>

          <table class="table table-borderless">
            <tbody>
              <tr>
                <td width="150"><strong>NIS</strong></td>
                <td>:</td>
                <td><?= session()->get('nim') ?></td>
              </tr>
              <tr>
                <td><strong>Nama Siswa</strong></td>
                <td>:</td>
                <td><?= session()->get('nama_anggota') ?></td>
              </tr>
              <tr>
                <td><strong>Jenis Kelamin</strong></td>
                <td>:</td>
                <td><?= session()->get('jenis_kelamin') ?></td>
              </tr>
              <?php if (session()->get('nama_kelas')) : ?>
              <tr>
                <td><strong>Kelas</strong></td>
                <td>:</td>
                <td><?= session()->get('nama_kelas') ?></td>
              </tr>
              <?php endif; ?>
              <tr>
                <td><strong>No Handphone</strong></td>
                <td>:</td>
                <td><?= session()->get('no_hp') ?></td>
              </tr>
              <tr>
                <td><strong>Alamat</strong></td>
                <td>:</td>
                <td><?= session()->get('alamat') ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

