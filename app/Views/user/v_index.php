<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>

                <div class="card-tools">
                  <a href="<?= base_url('admin/user/input') ?>" class="btn btn-flat btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                //notif insert data
                if(session()->getFlashdata('insert')){
                  echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
                  echo session()->getFlashdata('insert');
                  echo '</h5></div>';
                }

                //notif update data
                if(session()->getFlashdata('update')){
                  echo '<div class="alert alert-primary alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
                  echo session()->getFlashdata('update');
                  echo '</h5></div>';
                }

                 //notif update data
                 if(session()->getFlashdata('delete')){
                  echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
                  echo session()->getFlashdata('delete');
                  echo '</h5></div>';
                }

                ?>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center" >
                  <th style="width: 50px">No</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th style="width: 150px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
              <?php foreach ($users as $i => $a): ?>
                <tr class="text-center">
                  <td><?= $i + 1 ?></td>
                  <td>
                      <?php if ($a['foto']): ?>
                          <img src="<?= base_url('uploads/user/' . $a['foto']) ?>" alt="Foto" width="50" height="50" class="rounded-circle">
                      <?php else: ?>
                          <span class="text-muted">Tidak ada</span>
                      <?php endif; ?>
                  </td>
                  <td><?= esc($a['nama_user']) ?></td>
                  <td><?= esc($a['email']) ?></td>
                  <td>
                    <a href="<?= base_url('admin/user/detail/' . $a['id_user']) ?>" class="btn btn-success btn-sm" title="Lihat">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="<?= base_url('admin/user/edit/' . $a['id_user']) ?>" class="btn btn-warning btn-sm" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="<?= base_url('admin/user/delete/' . $a['id_user']) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?');">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </table>
              
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
