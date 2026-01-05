<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>

                <div class="card-tools">
                  <a href="<?= base_url('admin/slider/input') ?>" class="btn btn-flat btn-primary btn-sm">
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
                        <th>Foto slider</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no= 1;
                    foreach ($slider as $key => $value) { ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><img src="<?= base_url('uploads/web/'.$value['slider']) ?>" width="300px" height="150px"></td>
                            <td >
                              <a href="<?= base_url('admin/slider/delete/'. $value['id_slider']) ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></a>
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
