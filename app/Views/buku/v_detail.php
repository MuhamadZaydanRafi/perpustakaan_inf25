<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-4 text-center">
          <?php if($buku['cover']): ?>
            <img src="<?= base_url('uploads/cover/'. $buku['cover']) ?>" alt="Cover Buku" class="img-fluid rounded" style="max-height: 400px;">
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
                <td width="150"><strong>Kode Buku</strong></td>
                <td>:</td>
                <td><?= $buku['kode_buku'] ?></td>
              </tr>
              <tr>
                <td><strong>Judul Buku</strong></td>
                <td>:</td>
                <td><?= $buku['judul_buku'] ?></td>
              </tr>
              <tr>
                <td><strong>Kategori</strong></td>
                <td>:</td>
                <td><?= $buku['nama_kategori'] ?></td>
              </tr>
              <tr>
                <td><strong>Penulis</strong></td>
                <td>:</td>
                <td><?= $buku['nama_penulis'] ?></td>
              </tr>
              <tr>
                <td><strong>Penerbit</strong></td>
                <td>:</td>
                <td><?= $buku['nama_penerbit'] ?></td>
              </tr>
              <tr>
                <td><strong>Rak</strong></td>
                <td>:</td>
                <td><?= $buku['nama_rak'] ?></td>
              </tr>
              <tr>
                <td><strong>Tahun</strong></td>
                <td>:</td>
                <td><?= $buku['tahun'] ?></td>
              </tr>
              <tr>                <td><strong>Sinopsis</strong></td>
                <td>:</td>
                <td><?= nl2br($buku['sinopsis']) ?></td>
              </tr>
              <tr>                <td><strong>ISBN</strong></td>
                <td>:</td>
                <td><?= $buku['isbn'] ?></td>
              </tr>
              <tr>
                <td><strong>Halaman</strong></td>
                <td>:</td>
                <td><?= $buku['halaman'] ?></td>
              </tr>
              <tr>
                <td><strong>Jumlah</strong></td>
                <td>:</td>
                <td>
                  <span class="badge badge-info"><?= $buku['jumlah'] ?> Eksemplar</span>
                </td>
              </tr>
              <tr>
                <td><strong>Bahasa</strong></td>
                <td>:</td>
                <td><?= $buku['bahasa'] ?></td>
              </tr>
            </tbody>
          </table>

          <div class="mt-4">
            <a href="<?= base_url('admin/buku/edit/'. $buku['id_buku']) ?>" class="btn btn-warning btn-flat">
              <i class="fas fa-pencil-alt"></i> Edit
            </a>
            <a href="<?= base_url('admin/buku') ?>" class="btn btn-success btn-flat">
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
