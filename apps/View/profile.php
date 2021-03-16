<!DOCTYPE html>
<html>
<?php include_once "_partials/head.php" ?>

<body id="page-top">
  <div id="wrapper">
    <?php include_once "_partials/navigation.php" ?>
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        <?php include_once "_partials/header.php" ?>
        <div class="container-fluid">
          <h3 class="text-dark mb-4">Profile</h3>
          <div class="row mb-3">
            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-body text-center shadow">
                  <img class="rounded-circle mb-3 mt-4" src="<?= $imgsrc ?>" width="160" height="160">
                  <form method="post" id="fileForm" action="<?= base_url("/member/profile/photo") ?>" enctype='multipart/form-data'>
                    <div style="display:inline-flex">
                      <input type="file" id="myFile" name="file" style="display: none" required />
                      <input id="spnFilePath" class="form-control border-1 small" style="width: 100%;max-width:15em;" placeholder="Select picture to change" disabled>
                      <a class="btn btn-custom-primary text-white btn-sm link" id="btnFileUpload">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                      </a>
                    </div>
                    <div>
                      <input type="submit" class="btn btn-custom-primary text-white btn-sm" type="button" value="Change Photo" name="photo_settings" style="margin-top:10px;" />
                    </div>
                  </form>
                </div>
              </div>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <p class="text-custom-primary m-0 font-weight-bold">Signature Settings</p>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <form action="<?= base_url("/member/profile/signature") ?>" method="post">
                        <div class="form-group">
                          <label for="signature"><strong>Signature</strong><br></label>
                          <textarea class="form-control" rows="4" name="signature"><?= $signature; ?></textarea>
                        </div>
                        <div class="form-group">
                          <button class="btn btn-custom-primary text-white btn-sm" type="submit" name="signature_settings">Save Settings</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-8">
              <div class="row">
                <div class="col">

                  <div class="card shadow mb-3">
                    <div class="card-header py-3">
                      <p class="text-custom-primary m-0 font-weight-bold">User Settings</p>
                    </div>
                    <div class="card-body">
                      <form action="<?= base_url("/member/profile/info") ?>" method="post">
                        <div class="form-row">
                          <div class="col">
                            <div class="form-group">
                              <label for="username"><strong>Username</strong></label>
                              <input class="form-control" type="text" placeholder="user.name" name="username" value="<?= $username ?>" disabled="">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label for="email"><strong>Email Address</strong></label>
                              <input class="form-control" type="email" placeholder="user@example.com" value="<?= $email ?>" name="email">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <button class="btn btn-custom-primary text-white btn-sm" type="submit" name="user_settings">Save Settings</button>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="card shadow">
                    <div class="card-header py-3">
                      <p class="text-custom-primary m-0 font-weight-bold">Contact Settings</p>
                    </div>
                    <div class="card-body">
                      <form action="<?= base_url("/member/profile/contact") ?>" method="post">
                        <div class="form-group">
                          <label for="address"><strong>Address</strong></label>
                          <input class="form-control" type="text" placeholder="Address Line" value="<?= $address ?>" name="address">
                        </div>
                        <div class="form-row">
                          <div class="col">
                            <div class="form-group">
                              <label for="email"><strong>Email</strong></label>
                              <input class="form-control" type="email" placeholder="test@test.com" value="<?= $email ?>" name="email" disabled="">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label for="country"><strong>Phone Number</strong></label>
                              <input class="form-control" type="text" placeholder="+91-1234567890" value="<?= $phone ?>" name="phno">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <button class="btn btn-custom-primary text-white btn-sm" type="submit" name="contact_settings">Save Settings</button>
                        </div>
                      </form>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once "_partials/footer.php" ?>
    </div>
  </div>
  <?php include_once "_partials/scripts.php" ?>
  <script type="text/javascript">
    window.onload = function() {
      var fileupload = document.getElementById("myFile");
      var filePath = document.getElementById("spnFilePath");
      var button = document.getElementById("btnFileUpload");
      button.onclick = function() {
        fileupload.click();
      };
      fileupload.onchange = function() {
        var fileName = fileupload.value.split('\\')[fileupload.value
          .split('\\').length - 1];
        filePath.value = fileName;
      };
    };
  </script>
</body>

</html>