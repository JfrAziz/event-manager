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
          <div class="card shadow">
            <div class="card-header py-3">
              <p class="text-custom-primary m-0 font-weight-bold">Form Generator</p>
            </div>
            <div class="card-body">
              <div>
                <form action="" method="post" class="col" onsubmit="return validate_form()">
                  <div class="form-row">
                    <div class="col">
                      <div class="form-group">
                        <input class="form-control" type="text" placeholder="Event Name" name="event_name" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col">
                      <div class="form-group">
                        <textarea class="form-control" placeholder="Event Description" style="height: 100px;" name="event_desc" id="event_desc" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col">
                      <div class="form-group">
                        <input class="form-control" type="number" placeholder="Limit Participant" name="event_max" required>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="row">Event Date</div>
                    <div class="row">
                      <div class="col p-0">
                        <label class="form-control-label">Start Time:</label>
                        <div class="form-group">
                          <input type="date" class="form-control" name="event_start_date" id="event_start_date" required>
                        </div>
                        <div class="form-group">
                          <input type="time" class="form-control" name="event_start_time" id="event_start_time" required>
                        </div>
                      </div>
                      <div class="col p-0 pl-sm-2">
                        <label class="form-control-label">End Time:</label>
                        <div class="form-group">
                          <input type="date" class="form-control" name="event_end_date" id="event_end_date" required>
                        </div>
                        <div class="form-group">
                          <input type="time" class="form-control" name="event_end_time" id="event_end_time" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="row">Register Date</div>
                    <div class="row">
                      <div class="col p-0">
                        <label class="form-control-label">Start Date:</label>
                        <div class="form-group">
                          <input type="date" class="form-control" name="reg_start_date" id="reg_start_date" required>
                        </div>
                        <div class="form-group">
                          <input type="time" class="form-control" name="reg_start_time" id="reg_start_time" required>
                        </div>
                      </div>
                      <div class="col p-0 pl-sm-2">
                        <label class="form-control-label">End Date:</label>
                        <div class="form-group">
                          <input type="date" class="form-control" name="reg_end_date" id="reg_end_date" required>
                        </div>
                        <div class="form-group">
                          <input type="time" class="form-control" name="reg_end_time" id="reg_end_time" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class=col>
                      <input type="submit" name="submit" class="btn btn-custom-primary text-white">
                    </div>
                  </div>
                </form>

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
    function reverse_red(x) {
      var row = document.getElementById("alert_" + x);
      row.style.backgroundColor = "rgba(255,255,255,0)";
    }

    function validate_form() {
      var event_start = Date.parse(document.getElementById("event_start_date").value + ' ' + document.getElementById("event_start_time").value);
      var event_end = Date.parse(document.getElementById("event_end_date").value + ' ' + document.getElementById("event_end_time").value);
      var reg_start = Date.parse(document.getElementById("reg_start_date").value + ' ' + document.getElementById("reg_start_time").value);
      var reg_end = Date.parse(document.getElementById("reg_end_date").value + ' ' + document.getElementById("reg_end_time").value);

      eventDateDiff = event_end - event_start;
      regDateDiff = reg_end - reg_start;
      regPeriod = event_start - reg_end;

      if (eventDateDiff < 0) {
        message = "Rentang Waktu Pelaksanaan Event Tidak Valid";
        return false;
      } 
      if (regDateDiff < 0) {
        message = "Rentang Waktu Registrasi Tidak Valid";
        return false;
      } 
      if (regPeriod < 0) {
        message = "Periode Registrasi Harus Berakhir Sebelum Event Dimulai"
        return false;
      }
    }
  </script>
</body>

</html>