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
              <p class="text-primary m-0 font-weight-bold">Form Generator</p>
            </div>
            <div class="card-body">
              <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table dataTable my-0" id="dataTable">
                  <form action="" method="post" style="width: 60%;margin-left: 20%;margin-right: 20%" onSubmit="return validate_form();">
                    <tr id="alert_name">
                      <th>Event name</th>
                      <td onclick="reverse_red('name')">
                        <input type="text" class="form-control" name="event_name" id="input_name" />
                      </td>
                    </tr>
                    <tr id="alert_name">
                      <th>Event description</th>
                      <td>
                        <textarea class="form-control" name="event_description" id="event_desc"></textarea>
                      </td>
                    </tr>
                    <tr>
                      <th>Choose Type</th>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="event_type" value="individual" onclick="disable_dropdown()" checked>
                          <label class="form-check-label">
                            Individual
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="event_type" value="team" onclick="enable_dropdown()">
                          <label class="form-check-label">
                            Team
                          </label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Choose Number of Members (If Team)</th>
                      <td>
                        <select class="form-control" name="number_participants" id="number_participants" disabled>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </td>
                    </tr>

                    <tr id="alert_fields">
                      <th>Choose the Fields Needed</th>
                      <td onclick="reverse_red('fields')">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="regno" name="fields[]">
                          <label class="form-check-label">
                            Registration Number
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="fields[]" value="dept">
                          <label class="form-check-label">
                            Department
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="fields[]" value="year">
                          <label class="form-check-label">
                            Year
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="fields[]" value="email">
                          <label class="form-check-label">
                            E-mail address
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="fields[]" value="phoneno">
                          <label class="form-check-label">
                            Contact Number
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="fields[]" value="college">
                          <label class="form-check-label">
                            College
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="fields[]" value="github">
                          <label class="form-check-label">
                            GitHub Profile link
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="fields[]" value="linkedin">
                          <label class="form-check-label">
                            LinkedIn Profile Link
                          </label>
                        </div>

                      </td>

                    </tr>
                    <tr>

                      <td>
                        <input type="submit" style="margin-top: 1em;" name="submit" class="btn btn-primary mb-2">
                      </td>

                    </tr>
                  </form>

                </table>
                <script type="text/javascript">
                  function validate_form() {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);

                    var event_length = document.getElementById("input_name").value.replace(" ", "").length;
                    var name_row = document.getElementById("alert_name");
                    if (!event_length) name_row.style.backgroundColor = "rgba(255,0,0,0.1)";
                    var fields_row = document.getElementById("alert_fields");
                    if (!checkedOne) fields_row.style.backgroundColor = "rgba(255,0,0,0.1)";

                    return checkedOne;
                  }

                  function reverse_red(x) {
                    var row = document.getElementById("alert_" + x);
                    row.style.backgroundColor = "rgba(255,255,255,0)";
                  }

                  function disable_dropdown() {
                    document.getElementById("number_participants").disabled = true;
                  }

                  function enable_dropdown() {
                    document.getElementById("number_participants").disabled = false;
                  }
                </script>
              </div>
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