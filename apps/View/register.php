<html lang="en">

<?php include_once "_partials/head.php" ?>

<body class="" style="display: flex; align-items: center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-12 col-xl-10">
        <div class="card shadow-lg o-hidden border-0 my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 p-5 d-none d-lg-flex">
                <img class="img-fluid bg-login-image" src="<?= base_url("assets/img/register.svg") ?>">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-4">Daftar</h4>
                  </div>
                  <form class="user" action="<?= base_url("register") ?>" method="POST">
                    <div class="form-group">
                      <input autofocus class="form-control form-control-user" type="text" placeholder="Nama Pengguna" name="username">
                    </div>
                    <div class="form-group">
                      <input class="form-control form-control-user" type="text" placeholder="Nama Lengkap" name="fullname">
                    </div>
                    <div class="form-group">
                      <input class="form-control form-control-user" type="email" placeholder="Email" name="email">
                    </div>
                    <div style="position: relative;" class="form-group">
                      <input class="form-control input-sandi form-control-user" type="password" placeholder="Kata Sandi" name="password">
                      <div class="eye" style="user-select: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="cursor: pointer;position: absolute; width: 1.25rem; right: 1rem; top: 1rem;">
                          <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                          <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                      </div>
                    </div>
                    <div style="position: relative;" class="form-group">
                      <input class="form-control input-sandi form-control-user" type="password" placeholder="Konfirmasi Kata Sandi" name="password_conf">
                      <div class="eye" style="user-select: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="cursor: pointer;position: absolute; width: 1.25rem; right: 1rem; top: 1rem;">
                          <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                          <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                      </div>
                    </div>
                    <button class="btn btn-custom-primary btn-block text-white btn-user" type="submit">DAFTAR</button>
                  </form>
                  <div class="text-center">
                    <a class="small" href="<?= base_url("login") ?>">Sudah punya akun? Masuk</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include_once "_partials/scripts.php" ?>

</body>
<script src="<?= base_url('/assets/js/eye.js'); ?>"></script>

</html>