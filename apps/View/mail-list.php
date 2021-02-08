<html>

<?php include_once "_partials/head.php" ?>

<body id="page-top">
  <div id="wrapper">
    <?php include_once "_partials/navigation.php" ?>
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        <?php include_once "_partials/header.php" ?>
        <div class="container-fluid">
          <style>
            .upload-btn-wrapper input[type=file] {
              opacity: 0;
            }
          </style>
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-1">Mailing List Generator</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="Mailing-list/Sample_headers.csv">
              <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Sample CSV for Mailing list&nbsp;</a>
          </div>
          <div class="" style="padding-bottom: 30px; padding-top:30px">
            <form action="" method="post" enctype="multipart/form-data">
              <div style="display:inline-flex">
                <input type="file" id="myFile" name="file" style="display: none" required />
                <input id="spnFilePath" class="form-control border-1 small" style="width: 100%;max-width:15em;" placeholder="Selected Mailing list file" disabled>
                <a class="btn btn-primary btn-sm link" id="btnFileUpload">
                  <i class="fa fa-upload" aria-hidden="true"></i>
                </a>
                <script type="text/javascript">
                  // To hide the ugly file upload input and replace it with a button
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
              </div>
              <br><br>
              <div>
                <input type="text" name="mailer_name" class="form-control border-1 small" style="width: 68%;max-width:15em;" placeholder="Enter the Mailer Name" required />
                <br>
                <input class="btn btn-primary" type="submit" name="submit" />
              </div>
            </form>
          </div>
          <div class="card shadow">
            <div class="card-header py-3">
              <p class="text-primary m-0 font-weight-bold">Metadata</p>
            </div>
          </div>
        </div>
      </div>
      <?php include_once "_partials/footer.php" ?>
    </div>
  </div>
  <?php include_once "_partials/scripts.php" ?>
</body>

</html>