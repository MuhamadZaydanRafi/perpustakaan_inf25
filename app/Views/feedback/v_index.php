<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>

            <div class="card-tools">
                <a href="<?= base_url('admin/feedback/input') ?>" class="btn btn-flat btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            //notif insert data
            if(session()->getFlashdata('success')){
                echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('success');
                echo '</h5></div>';
            }

            //notif error
            if(session()->getFlashdata('error')){
                echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-times"></i>';
                echo session()->getFlashdata('error');
                echo '</h5></div>';
            }
            ?>
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped" style="width: 100%; table-layout: auto;">
                    <thead>
                        <tr class="text-center">
                            <th style="width: auto; min-width: 40px;">No</th>
                            <th style="width: auto; min-width: 100px;">Nama</th>
                            <th style="width: auto; min-width: 150px;">Komentar</th>
                            <th style="width: auto; min-width: 150px;">Keluhan</th>
                            <th style="width: auto; min-width: 100px;">Penilaian</th>
                            <th style="width: auto; min-width: 150px;">Saran</th>
                            <th style="width: auto; min-width: 70px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($feedback as $key => $value) { ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= substr($value['komentar'], 0, 50) ?></td>
                                <td><?= substr($value['keluhan'], 0, 50) ?></td>
                                <td><?= $value['penilaian'] ?></td>
                                <td><?= substr($value['saran'], 0, 50) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/feedback/delete/'. $value['id_feedback']) ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
