    
    <div class="col-sm-12">
      <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <?php foreach( $slider as $key => $a) { ?>
                    <div class="carousel-item <?= $a['id_slider'] ==1 ? 'active' : '' ?>">
                      <img class="d-block w-100" src="<?= base_url('uploads/web/'.$a['slider']) ?>" alt="First slide">
                    </div>
                    <?php } ?>
                   
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 
          </div>
          <!-- /.col -->
            <div class="col-sm-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Buku Baru</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <?php foreach($buku as $key => $value) { ?>
                    <div class="col-md-3">
                      <div class="card">
                        <div class="text-center p-3">
                          <?php if($value['cover']): ?>
                            <img src="<?= base_url('uploads/cover/'. $value['cover']) ?>" alt="cover" style="max-width: 200px; height: auto;">
                          <?php else: ?>
                            <span class="badge badge-warning">Tidak ada</span>
                          <?php endif; ?>
                        </div>
                        <div class="card-body">
                          <h5><b><?= $value['judul_buku'] ?></b></h5>
                          <p><b>Penerbit:</b> <?= $value['nama_penerbit'] ?><br>
                            <b>Penulis:</b> <?= $value['nama_penulis'] ?><br>
                          </p>
                          <a href="<?= base_url('detailbuku/'. $value['id_buku']) ?>" class="btn btn-primary btn-block">Detail</a>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
            <div class="col-sm-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">E-Book Baru </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class="row">
                  <?php foreach($ebook as $key => $value) { ?>
                    <div class="col-md-3">
                      <div class="card">
                        <div class="text-center p-3">
                          <?php if($value['cover']): ?>
                            <img src="<?= base_url('uploads/cover/'. $value['cover']) ?>" alt="cover" style="max-width: 200px; height: auto;">
                          <?php else: ?>
                            <span class="badge badge-warning">Tidak ada</span>
                          <?php endif; ?>
                        </div>
                        <div class="card-body">
                          <h5><b><?= $value['judul_ebook'] ?></b></h5>
                          <p><b>Penerbit:</b> <?= $value['nama_penerbit'] ?><br>
                            <b>Penulis:</b> <?= $value['nama_penulis'] ?><br>
                          </p>
                          <a href="<?= base_url('detailebook/'. $value['id_ebook']) ?>" class="btn btn-primary btn-block" target="_blank">Detail</a>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
               </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->