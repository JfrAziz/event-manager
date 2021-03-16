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
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">View Responses</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-4">
                            <form>
                                <select id="event_select" class="form-control border-1 small"
                                    style="width: 68%;max-width:15em;" required>
                                    <option style="display:none" disabled selected value>Select event</option>
                                    <?php foreach ($event as $row) : ?>
                                    <option value="<?= $row['name']?>" data-id="<?= $row['id']?>" />
                                    <?= $row['name']?>
                                    </option>
                                    <?php endforeach; ?>
                                </select><br>
                            </form>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card shadow border-left-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                                                <span>Total Responses</span>
                                            </div>
                                            <div class="text-dark font-weight-bold h5 mb-0">
                                                <span id="countPart">
                                                    No event chosen
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <div class="text-custom-primary m-0 font-weight-bold" id="event_name">
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table-data">
                                <thead>
                                    <tr>
                                        <th>No reg</th>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div id="tblRow">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </div>
                                </tbody>


                            </table>


                        </div>
                    </div>
                </div>
                <br><br>
            </div>
            <?php include_once "_partials/footer.php" ?>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#table-data').DataTable({
            "columns": [{
                    "data": "regno"
                }, {
                    "data": "fullname"
                },
                {
                    "data": "email"
                },
                {
                    "data": "address"
                },
                {
                    "data": "phone"
                }
            ]
        });
    });

    $('#event_select').on('change', function() {
        var table = $('#table-data').DataTable();
        var idEvt = $('option:selected', this).data("id");
        table.clear();
        $.get("http://localhost:8080/member/form/selectevt", {
            id_event: idEvt
        }, function(result) {
            var data = JSON.parse(result);
            table.rows.add(data);
            $("#countPart").text(Object.keys(data).length);
            table.draw();
        });
        $("#event_name").text(this.value);

    });


    $body = $("body");

    $(document).on({
        ajaxStart: function() {
            $body.addClass("loading");
        },
        ajaxStop: function() {
            $body.removeClass("loading");
        }
    });
    </script>
    <?php include_once "_partials/scripts.php" ?>
    <div class="modalLoad">
        <!-- Place at bottom of page -->
    </div>
</body>

</html>