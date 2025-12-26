<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>

                <div class="card-tools">
                  <a href="<?= base_url('admin/kelas/input') ?>" class="btn btn-flat btn-primary btn-sm">
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
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Kelas</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no= 1;
                    foreach ($kelas as $key => $value) { ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_kelas'] ?></td>
                            <td >
                              <a href="<?= base_url('admin/kelas/edit/'. $value['id_kelas']) ?>" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                              <a href="<?= base_url('admin/kelas/delete/'. $value['id_kelas']) ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                   <?php } ?> 
                </tbody>
              </table>
              
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
