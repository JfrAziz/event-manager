<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
  <div class="container-fluid">
    <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
        <div class="input-group-append">
          <button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
    <ul class="nav navbar-nav flex-nowrap ml-auto">
      <li class="nav-item dropdown d-sm-none no-arrow">
        <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
          <i class="fas fa-search"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
          <form class="form-inline mr-auto navbar-search w-100">
            <div class="input-group">
              <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
              <div class="input-group-append">
                <button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1" role="presentation">
        <div class="nav-item dropdown no-arrow">
          <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
            <span class="badge badge-danger badge-counter"><?= $readReamining ?></span><i class="fas fa-bell fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in" role="menu">
            <h6 class="dropdown-header">alerts center</h6>
            <a class="d-flex align-items-center dropdown-item" href="#">

              <?php if (!(empty($alertArray))) : ?>
                <?php foreach ($alertArray as $alert) : ?>
                  <?php if (empty($displayCircles[$alert["type"]])) : ?>
                    <a class="d-flex align-items-center dropdown-item" href="<?= $alert[" clickURL"] ?>">
                      <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="/assets/img/avatars/users/<?= $alert[" imgsrc"] ?>" />
                        <div class="bg-success"></div>
                      </div>
                      <div class="font-weight-bold">
                        <div class="text-truncate"><span><?= $alert["message"] ?></span></div>
                        <p class="small text-gray-500 mb-0"><?= $alert["user"] ?> - <?= $alert["timestamp"] ?></p>
                      </div>
                    </a>
                  <?php else : ?>
                    <a class="d-flex align-items-center dropdown-item" href="">
                      <div class="mr-3">
                        <?= $displayCircles[$alert["type"]] ?>
                      </div>
                      <div class="font-weight-bold">
                        <div class="text-truncate"><span><?= $alert["message"] ?></span></div>
                        <p class="small text-gray-500 mb-0"><?= $alert["user"] ?> - <?= $alert["timestamp"] ?></p>
                      </div>
                    </a>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php else : ?>
                <span class="text-center dropdown-item small text-gray-500">No new alerts</span>
              <?php endif; ?>

              <a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1" role="presentation">
        <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
      </li>

      <div class="d-none d-sm-block topbar-divider"></div>

      <li class="nav-item dropdown no-arrow" role="presentation">
        <div class="nav-item dropdown no-arrow">
          <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
            <span class="d-none d-lg-inline mr-2 text-gray-600 small"><?= $_SESSION['uname'] ?></span>
          </a>
          <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
            <a class="dropdown-item" role="presentation" href="<?= base_url("member/profile") ?>">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" role="presentation" href="<?= base_url("logout") ?>">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
            </a>
          </div>
        </div>
      </li>

    </ul>
  </div>
</nav>