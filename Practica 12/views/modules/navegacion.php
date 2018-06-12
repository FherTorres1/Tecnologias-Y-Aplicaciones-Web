<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link bg-success">
      <img src="views/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Sistema de inventarios</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="views/dist/img/avatar04.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'];?></a>
          <i class="fa fa-circle text-success"></i>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?action=productos" class="nav-link">
              <i class="nav-icon fa fa-tv"></i>
              <p>Inventario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?action=usuarios" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?action=categorias" class="nav-link">
              <i class="nav-icon fa fa-tags"></i>
              <p>Categorias</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?action=salir" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  </div>
  </body>