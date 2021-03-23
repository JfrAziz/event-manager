<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
  <div class="container-fluid">
    <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
    <ul class="nav navbar-nav flex-nowrap ml-auto">
      <div class="d-none d-sm-block topbar-divider"></div>

      <li class="nav-item dropdown no-arrow" role="presentation">
        <div class="nav-item dropdown no-arrow">
          <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
            <span class="d-none d-lg-inline mr-2 text-gray-600 small"><?= $_SESSION['fullname'] ?></span>
          </a>
          <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
            <a class="dropdown-item" role="presentation" href="<?= base_url("member/profile") ?>">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profil
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" role="presentation" href="<?= base_url() ?>">
              <i class="fas fa-link fa-sm fa-fw mr-2 text-gray-400"></i>Buka Web
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" role="presentation" href="<?= base_url("logout") ?>">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Keluar
            </a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>