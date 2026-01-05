<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PINF25 | <?=$judul ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <?php 
  $db = \Config\Database::connect();
  $web = $db->table('tbl_web')->getWhere(['id_web' => 1])->getRowArray();
  ?>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <h3><b><?= $web['nama_web'] ?></b></h3> 
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('log_out_admin') ?>">
          <i class="fas fa-sign-out-alt"></i> LogOut
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('uploads/web/'.$web['logo']) ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PERPUSTAKAAN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
            $foto = session()->get('foto');
            $fotoPath = 'uploads/user/'. $foto;
            $fileExists = !empty($foto) && file_exists(FCPATH . $fotoPath);
          ?>
          <img src="<?= $fileExists ? base_url($fotoPath) : base_url('AdminLTE/dist/img/avatar.png') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session()->get('nama_user') ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('admin') ?>" class="nav-link <?=  (isset($menu) ? $menu : '')=='dashboard' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dasboard
              </p>
            </a>
          </li>
          <li class="nav-item <?=  (isset($menu) ? $menu : '')=='masterdata' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?=  (isset($menu) ? $menu : '')=='masterdata' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Master Buku
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/kategori') ?>" class="nav-link <?=  (isset($submenu) ? $submenu : '')=='kategori' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/rak') ?>" class="nav-link <?=  (isset($submenu) ? $submenu : '')=='rak' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rak</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/penerbit') ?>" class="nav-link <?=  (isset($submenu) ? $submenu : '')=='penerbit' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penerbit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/penulis') ?>" class="nav-link <?=  (isset($submenu) ? $submenu : '')=='penulis' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penulis</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?=  (isset($menu) ? $menu : '')=='masteranggota' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?=  (isset($menu) ? $menu : '')=='masteranggota' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Master Anggota
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/anggota') ?>" class="nav-link <?=  (isset($submenu) ? $submenu : '')=='anggota' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>anggota</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?=  (isset($menu) ? $menu : '')=='pengaturan' ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?=  (isset($menu) ? $menu : '')=='pengaturan' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
               Pengaturan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?= base_url('admin/pengaturan') ?>" class="nav-link <?=  (isset($submenu) ? $submenu : '')=='pengaturan_web' ? 'active' : '' ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Pengaturan Web</p>
              </a>
              </li>
              <li class="nav-item">
              <a href="<?= base_url('admin/slider') ?>" class="nav-link <?=  (isset($submenu) ? $submenu : '')=='slider' ? 'active' : '' ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Slider</p>
              </a>
              </li> 
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/user') ?>" class="nav-link <?=  (isset($menu) ? $menu : '')=='user' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
          <?php 
                if ($page) {
                    echo view($page);
                }          
            ?>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2026 <a href="#">PERPUSTAKAAN <?= $web['nama_web'] ?></a>.</strong> 
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "paging": true,
      "searching": true,
      "lengthChange": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
</body>
</html>
