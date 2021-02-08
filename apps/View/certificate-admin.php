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
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Certificate Generation</h3>
            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="CDS_Admin/Sample_headers.csv">
              <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Download Sample CSV for CDS&nbsp;
            </a>
          </div>
          <style>
            .upload-btn-wrapper input[type=file] {
              opacity: 0;
            }
          </style>
          <div class="" style="padding-bottom: 19px;">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
              <div style="display:inline-flex">
                <input type="file" id="myFile" name="file" style="display: none" required />
                <input id="spnFilePath" class="form-control border-1 small" style="width: 100%;max-width:15em;" placeholder="Selected certificate list" disabled>
                <a class="btn btn-primary btn-sm link" id="btnFileUpload">
                  <i class="fa fa-upload" aria-hidden="true"></i>
                </a>
              </div>
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
              <br><br>
              <input type="text" name="event_name" class="form-control border-1 small" style="width: 68%;max-width:15em;" placeholder="Enter the Event Name" required />
              <br>
              <input type="text" name="date" class="form-control border-1 small" style="width: 68%;max-width:15em;" placeholder="Enter the Date of the event" required />
              <br>
              <select class="form-control border-1 small" style="width: 68%;max-width:15em;" name="eventType" required>
                <option value="0">Intra-College Event</option>
                <option value="1">Inter-College Event</option>
              </select>
              <br>
              <input class="btn btn-primary" type="submit" name="submit" />
            </form>
          </div>

          <div class="card shadow">
            <div class="card-header py-3">
              <p class="text-primary m-0 font-weight-bold">Metadata</p>
            </div>
            <div class="card-body">
            </div>
          </div>
          <br><br>
          <div class="card shadow">
            <div class="card-header py-3">
              <p class="text-primary m-0 font-weight-bold">Certification Creation Log</p>
            </div>
            <div class="card-body">
              <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table dataTable my-0" id="dataTable">
                  <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <?php if ($event_type == 0) : ?>
                      <th>Registration Number</th>
                    <?php else : ?>
                      <th>College</th>
                    <?php endif; ?>
                    <th>Position</th>
                    <th>Event Name</th>
                    <th>Certificate Link</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <br><br>
        </div>
      </div>

      <?php include_once "_partials/footer.php" ?>
    </div>
  </div>
  <?php include_once "_partials/scripts.php" ?>
</body>

</html>