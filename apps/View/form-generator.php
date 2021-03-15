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
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable">
                                    <form action="form/addevent" method="post" style="width: 60%;margin-left: 20%;margin-right: 20%">
                                        <tr id="alert_name">
                                            <th>Event Name</th>
                                            <td onclick="reverse_red('name')">
                                                <input type="text" class="form-control" name="event_name"
                                                    id="event_name" />
                                            </td>
                                        </tr>
                                        <tr id="alert_name">
                                            <th>Event Description</th>
                                            <td>
                                                <textarea class="form-control" name="event_desc"
                                                    id="event_desc"></textarea>
                                            </td>
                                        </tr>
                                        <tr id="alert_name">
                                            <th>Limit Participant</th>
                                            <td>
                                                <input type="number" class="form-control" name="event_participant"
                                                    id="event_participant" min="0"/>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Event Date</th>
                                            <td onclick="reverse_red('fields')">
                                            <div class="form-inline">
                                                <div class="form-check">
                                                <label class="form-control-label mb-2 mr-sm-2 mb-sm-0">
                                                        Start Date:
                                                    </label>
                                                    <div class="form-inline">
                                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="date" class="form-control"
                                                                name="event_start_date" id="event_start_date">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="time" class="form-control"
                                                                name="event_start_time" id="event_start_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                <label class="form-control-label ml-3 mb-2 mr-sm-2 mb-sm-0">
                                                        End Date:
                                                    </label>
                                                    <div class="form-inline">
                                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="date" class="form-control"
                                                                name="event_end_date" id="event_end_date">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="time" class="form-control"
                                                                name="event_end_time" id="event_end_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Register Date</th>
                                            <td onclick="reverse_red('fields')">
                                            <div class="form-inline">
                                                <div class="form-check">
                                                    <label class="form-control-label mb-2 mr-sm-2 mb-sm-0">
                                                        Start Date:
                                                    </label>
                                                    <div class="form-inline">
                                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="date" class="form-control"
                                                                name="reg_start_date" id="reg_start_date">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="time" class="form-control"
                                                                name="reg_start_time" id="reg_start_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-control-label ml-3 mb-2 mr-sm-2 mb-sm-0">
                                                        End Date:
                                                    </label>
                                                    <div class="form-inline">
                                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="date" class="form-control"
                                                                name="reg_end_date" id="reg_end_date">
                                                        </div>
                                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                            <input type="time" class="form-control"
                                                                name="reg_end_time" id="reg_end_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                <input type="submit" style="margin-top: 1em;" name="submit"
                                                    class="btn btn-primary mb-2">
                                            </td>

                                        </tr>
                                    </form>

                                </table>
                                <script type="text/javascript">
                                /*function validate_form() {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);

                    var event_length = document.getElementById("input_name").value.replace(" ", "").length;
                    var name_row = document.getElementById("alert_name");
                    if (!event_length) name_row.style.backgroundColor = "rgba(255,0,0,0.1)";
                    var fields_row = document.getElementById("alert_fields");
                    if (!checkedOne) fields_row.style.backgroundColor = "rgba(255,0,0,0.1)";

                    return checkedOne;
                  }*/

                                function reverse_red(x) {
                                    var row = document.getElementById("alert_" + x);
                                    row.style.backgroundColor = "rgba(255,255,255,0)";
                                }
                                /*

                                function disable_dropdown() {
                                  document.getElementById("number_participants").disabled = true;
                                }

                                function enable_dropdown() {
                                  document.getElementById("number_participants").disabled = false;
                                }*/
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