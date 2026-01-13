<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-4 text-center">
          <?php if($ebook['cover']): ?>
            <img src="<?= base_url('uploads/cover/'. $ebook['cover']) ?>" alt="Cover E-Book" class="img-fluid rounded" style="max-height: 400px;">
          <?php else: ?>
            <div class="alert alert-warning">
              <i class="fas fa-image"></i> Tidak ada cover
            </div>
          <?php endif; ?>
        </div>
        <div class="col-md-8">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td width="150"><strong>Judul E-Book</strong></td>
                <td>:</td>
                <td><?= $ebook['judul_ebook'] ?></td>
              </tr>
              <tr>
                <td><strong>Kategori</strong></td>
                <td>:</td>
                <td><?= $ebook['nama_kategori'] ?></td>
              </tr>
              <tr>
                <td><strong>Penulis</strong></td>
                <td>:</td>
                <td><?= $ebook['nama_penulis'] ?></td>
              </tr>
              <tr>
                <td><strong>Penerbit</strong></td>
                <td>:</td>
                <td><?= $ebook['nama_penerbit'] ?></td>
              </tr>
              <tr>
                <td><strong>Tahun</strong></td>
                <td>:</td>
                <td><?= $ebook['tahun'] ?></td>
              </tr>
              <tr>
                <td><strong>ISBN</strong></td>
                <td>:</td>
                <td><?= $ebook['isbn'] ?></td>
              </tr>
              <tr>
                <td><strong>Bahasa</strong></td>
                <td>:</td>
                <td><?= $ebook['bahasa'] ?></td>
              </tr>
              <tr>
                <td><strong>Sinopsis</strong></td>
                <td>:</td>
                <td><?= nl2br($ebook['sinopsis']) ?></td>
              </tr>
              <tr>
                <td><strong>File E-Book</strong></td>
                <td>:</td>
                <td>
                  <?php if($ebook['file_ebook']): ?>
                    <a href="<?= base_url('admin/ebook/download/'. $ebook['id_ebook']) ?>" class="btn btn-sm btn-info btn-flat">
                      <i class="fas fa-download"></i> Download PDF
                    </a>
                  <?php else: ?>
                    <span class="badge badge-warning">Tidak ada file</span>
                  <?php endif; ?>
                </td>
              </tr>
            </tbody>
          </table>

          <div class="mt-4">
            <a href="<?= base_url('galeryebook') ?>" class="btn btn-success btn-flat">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
