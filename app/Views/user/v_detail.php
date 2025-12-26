<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <div class="row">

                <!-- FOTO DI TENGAH + JARAK -->
                <div class="col-sm-12 text-center mb-4">
                    <img src="<?= base_url('uploads/admin/' . $users['foto']) ?>" 
                         width="200px" class="img-thumbnail">
                </div>

                <!-- TABEL -->
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Admin</th>
                            <th width="30px">:</th>
                            <td><?= $users['nama_user'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <td><?= $users['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <th>:</th>
                            <td><?= $users['role'] ?></td>
                        </tr>
                            <th>Password</th>
                            <th>:</th>
                            <td><?= $users['password'] ?></td>
                        </tr>
                    </table>

                    <a href="<?= base_url('admin/user') ?>" class="btn btn-success btn-flat">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
