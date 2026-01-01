<div class="col-md-12">
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="col-sm-12 text-center mb-4">
            <?php $foto = session()->get('foto') ? session()->get('foto') : 'default.png'; ?>
            <img src="<?= base_url('uploads/anggota/' . $foto) ?>" 
                width="200" class="img-thumbnail" alt="Foto Anggota">
        </div>

        <h3 class="profile-username text-center"><?= session()->get('nama_anggota') ?></h3>

        <div class="col-sm-12">
                    <table class="table">
                        <tr>
                            <th>NIM</th>
                            <th>:</th>
                            <td><?= session()->get('nim') ?></td>
                        </tr>

                        <tr>
                            <th>Alamat Rumah</th>
                            <th>:</th>
                            <td><?= session()->get('alamat') ?></td>
                        </tr>

                        <tr>
                            <th>Jenis Kelamin</th>
                            <th>:</th>
                            <td><?= session()->get('jenis_kelamin') ?></td>
                        </tr>

                        <tr>
                            <th>Nomor HP</th>
                            <th>:</th>
                            <td><?= session()->get('no_hp') ?></td>
                        </tr>

                        <?php if (session()->get('nama_kelas')) : ?>
                        <tr>
                            <th>Kelas</th>
                            <th>:</th>
                            <td><?= session()->get('nama_kelas') ?></td>
                        </tr>
                        <?php endif; ?>

                    </table>
                </div>

        <div class="text-center mt-3">
            <a href="<?= base_url('anggota/edit_profil/' . session()->get('id_anggota')) ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                <b>Edit Profil</b>
            </a>
        </div>
        </div>
              <!-- /.card-body -->
 </div>
     <!-- /.card -->
</div>

