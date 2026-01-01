<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>

                <div class="card-tools">
                  <a href="<?= base_url('admin/anggota/input') ?>" class="btn btn-flat btn-primary btn-sm">
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center" >
                  <th style="width: 50px">No</th>
                  <th>Foto</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th style="width: 150px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
              <?php foreach ($anggotawithkelas as $i => $a): ?>
                <tr class="">
                  <td><?= $i + 1 ?></td>
                  <td class="text-center">
                      <?php if ($a['foto']): ?>
                          <img src="<?= base_url('uploads/anggota/' . $a['foto']) ?>" alt="Foto" width="50" height="50" class="rounded-circle">
                      <?php else: ?>
                          <span class="text-muted">Tidak ada</span>
                      <?php endif; ?>
                  </td>
                  <td><?= esc($a['nama_anggota']) ?><br>
                   <?php if (isset($a['verifikasi']) && $a['verifikasi']==1) {
                    echo '<span class="text-success"> <i class="fas fa-check"></i> Terverifikasi</span>';
                   }
                   else{
                    echo '<span class="text-danger"> <i class="fas fa-times"></i> Belum Terverifikasi</span><br>';
                    echo '<a href="' . base_url('admin/anggota/verifikasi/' . $a['id_anggota']) . '" class="btn btn-sm btn-primary">Verifikasi</a>';
                   } ?>
                </td>
                  <td><?= esc($a['nim']) ?></td>
                  <td>
                    <a href="<?= base_url('admin/anggota/detail/' . $a['id_anggota']) ?>" class="btn btn-success btn-sm" title="Lihat">
                      <i class="fas fa-eye"></i>
                    </a>
                     <a href="<?= base_url('admin/anggota/edit/' . $a['id_anggota']) ?>" class="btn btn-warning btn-sm" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="<?= base_url('admin/anggota/delete/' . $a['id_anggota']) ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?');">
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
