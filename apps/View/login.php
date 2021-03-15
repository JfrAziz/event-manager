<html lang="en">

<?php include_once "_partials/head.php" ?>

<body class="">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-12 col-xl-10">
        <div class="card shadow-lg o-hidden border-0 my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 p-5 d-none d-lg-flex">
                <img class="img-fluid bg-login-image" src="<?= base_url("assets/img/login.svg") ?>">
              </div>
              <div class="col-lg-6" style="background-color: white;">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-4">Login Admin</h4>
                  </div>
                  <form class="user" action="<?= base_url("login") ?>" method="POST">
                    <div class="form-group">
                      <input class="form-control form-control-user" type="text" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                      <input class="form-control form-control-user" type="password" placeholder="Password" name="password">
                    </div>
                    <button class="btn btn-custom-primary btn-block text-white btn-user" type="submit">LOGIN
                    </button>
                  </form>
                  <div class="text-center">
                    <a class="small" href="<?= base_url("forgot-password") ?>">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= base_url("register") ?>">Don't have account? Register</a>
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

</html>