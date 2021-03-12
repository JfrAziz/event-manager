<!DOCTYPE html>
<html lang="en">

<?php include_once "_partials/head.php" ?>

<body id="page-top">
  <div id="wrapper">
    <?php include_once "_partials/navigation.php" ?>
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        <?php include_once "_partials/header.php" ?>
        <div class="container-fluid">
          <div class="card shadow my-3">
            <div class="card-header">
              <div class="d-sm-flex justify-content-between align-items-center">
                <p class="text-primary m-0 font-weight-bold">Certificate Generation</p>
                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="CDS_Admin/Sample_headers.csv">
                  <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Sample CSV for CDS&nbsp;
                </a>
              </div>
            </div>
            <div class="card-body">
              <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6 pt-3">
                    <div style="display:inline-flex">
                      <input type="file" id="myFile" name="file" style="display: none" required />
                      <input id="spnFilePath" class="form-control border-1" placeholder="Selected certificate list" disabled>
                      <a class="btn btn-primary btn-sm link" id="btnFileUpload">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-6 pt-3">
                    <input type="text" name="event_name" class="form-control border-1 small" placeholder="Enter the Event Name" required />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pt-3">
                    <input type="text" name="date" class="form-control border-1 small" placeholder="Enter the Date of the event" required />
                  </div>
                  <div class="col-md-6 pt-3">
                    <select class="form-control border-1 small" name="eventType" required>
                      <option value="0">Intra-College Event</option>
                      <option value="1">Inter-College Event</option>
                    </select>
                  </div>
                </div>
                <div class="row pt-3">
                  <div class="col">
                    <input class="btn btn-primary" type="submit" name="submit" />
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card shadow">
            <div class="card-header py-3">
              <p class="text-primary m-0 font-weight-bold">Metadata</p>
            </div>
            <div class="card-body">
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