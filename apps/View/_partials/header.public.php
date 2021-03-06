<nav class="navbar navbar-light navbar-expand bg-white mb-4 topbar shadow static-top">
  <div class="container d-flex align-items-center">
    <div class="d-none d-md-flex">
      <a href="<?= base_url() ?>" rel="home" class="logo d-flex align-items-center">
        <img alt="BootstrapMade" src="<?= base_url("/assets/img/logo.png") ?>" height="50">
      </a>
    </div>
    <ul class="nav navbar-nav flex-nowrap ml-auto">
      <form class="form-inline ml-auto mr-2 mr-md-5">
        <div class="input-group">
          <input id="cariEvent" class="bg-light form-control border-1" type="text" placeholder="Cari Acara">
          <div class="input-group-append">
            <button class="btn btn-custom-primary text-white py-0" type="button"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </form>
      <li class="nav-item d-flex align-items-center" role="presentation">
        <a href="<?= base_url("login") ?>" class="btn btn-custom-primary text-white"><?= $_SESSION ? "DASHBOARD" : "MASUK" ?></a>
      </li>
    </ul>
  </div>
</nav>