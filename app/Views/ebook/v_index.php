<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>

      <div class="card-tools">
        <a href="<?= base_url('admin/ebook/input') ?>" class="btn btn-flat btn-primary btn-sm">
          <i class="fas fa-plus"></i> Tambah
        </a>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
      //notif success
      if(session()->getFlashdata('success')){
        echo '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i>';
        echo session()->getFlashdata('success');
        echo '</h5></div>';
      }

      //notif error
      if(session()->has('errors')){
        echo '<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-times"></i> Error</h5>';
        foreach(session()->getFlashdata('errors') as $error):
          echo '<p>' . $error . '</p>';
        endforeach;
        echo '</div>';
      }
      ?>
      <table id="example2" class="table table-bordered table-striped">
        <thead>
          <tr class="text-center">
            <th width="50px">No</th>
            <th>Cover</th>
            <th>Judul E-Book</th>
            <th>ISBN</th>
            <th>File</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($ebook as $key => $value) { ?>
            <tr class="">
              <td><?= $no++ ?></td>
              <td class="text-center">
                <?php if($value['cover']): ?>
                  <img src="<?= base_url('uploads/cover/'. $value['cover']) ?>" alt="cover" style="max-width: 200px; height: auto;">
                <?php else: ?>
                  <span class="badge badge-warning">Tidak ada</span>
                <?php endif; ?>
              </td>
              <td><h5><b><?= $value['judul_ebook'] ?></b></h5>
              <p><b>Penerbit:</b> <?= $value['nama_penerbit'] ?><br>
                <b>Penulis:</b> <?= $value['nama_penulis'] ?><br>
                <b>Tahun:</b> <?= $value['tahun'] ?></p><br>
                </td> 
              <td><?= $value['isbn'] ?></td>
              <td class="text-center">
                <?php if($value['file_ebook']): ?>
                  <a href="<?= base_url('admin/ebook/download/'. $value['id_ebook']) ?>" class="badge badge-success" title="Download">
                    <i class="fas fa-download"></i>
                  </a>
                <?php else: ?>
                  <span class="badge badge-warning">Tidak ada</span>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= base_url('admin/ebook/detail/'. $value['id_ebook']) ?>" class="btn btn-sm btn-info btn-flat"><i class="fas fa-eye"></i></a>
                <a href="<?= base_url('admin/ebook/edit/'. $value['id_ebook']) ?>" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                <a href="<?= base_url('admin/ebook/delete/'. $value['id_ebook']) ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></a>
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
