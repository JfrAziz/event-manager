<!DOCTYPE html>
<html>
<?php include_once "_partials/head.php" ?>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-12 col-xl-10">
        <div class="card shadow-lg o-hidden border-0 my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-flex">
                <div class="flex-grow-1 bg-password-image" style="background-image: url(&quot;../assets/img/front/image2.png&quot;);"></div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-5">Create your new password</h4>
                  </div>
                  <form class="user" action="" method="post" onSubmit="return checkMatch();">
                    <input type="hidden" name="gen" value=<?= $gen; ?> >
                    <div class="form-group">
                      <input class="form-control form-control-user" type="password" id="pwd" placeholder="Enter New Password" name="pwd">
                    </div>
                    <div class="form-group">
                      <input class="form-control form-control-user" type="password" id="pwd_confirm" placeholder="Confirm password" name="pwd_confirm">
                    </div>
                    <p style='text-align:center;font-size:15px;color:red' id="password_match"></p>
                    <button class="btn btn-primary btn-block text-white btn-user" type="submit" name="submit">Reset Password</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?= base_url("login") ?>">Already have an account? Login!</a>
                  </div>
                </div>
                <script>
                  function checkMatch() {
                    var pwd1 = document.getElementById('pwd').value;
                    var pwd2 = document.getElementById('pwd_confirm').value;
                    if (pwd1.replace(" ", "").length == 0 || pwd2.replace(" ", "").length == 0) {
                      document.getElementById('password_match').innerHTML = 'Fields Empty';
                      return false;
                    }
                    if (pwd1 == pwd2) {
                      return true;
                    } else {
                      document.getElementById('password_match').innerHTML = 'Passwords do not match!';
                      return false;
                    }
                  }
                </script>
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