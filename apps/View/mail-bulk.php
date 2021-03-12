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
              <p class="text-primary m-0 font-weight-bold">Bulk Mailer</p>
            </div>
            <div class="card-body" style="margin-left: -5px; margin-right: -5px;">
              <form method="POST" action="send.php" id="form" enctype="multipart/form-data">
                <div class="form-row" id="subject" style="margin-left: 3px;margin-top: 20px;margin-right: 3px;">
                  <div class="col">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Subjek" name="mail_subject">
                    </div>
                  </div>
                </div>

                <div class="form-row" id="body" style="margin-left: 3px;margin-top: 10px;margin-right: 3px;">
                  <div class="col">
                    <div class="form-group">
                      <textarea class="form-control" placeholder="Pesan" style="height: 100px;" name="mail_body" id="mail_body"></textarea>
                    </div>
                  </div>
                </div>

                <div class="form-row" id="error-msg" style="margin-left: 3px;margin-top: 10px;margin-right: 3px; margin-bottom: -7px; display: none;">
                  <div class="col">
                    <div class="alert alert-danger" role="alert" style="padding: 0 3px 0 5px; margin-top: -22px;margin-bottom: 0; font-size: 12px;">
                      Pesan Harus Diisi
                    </div>
                  </div>
                </div>

                <div class="form-row" id="file-body" style="margin-left: 3px;margin-top: 10px;margin-right: 3px; margin-bottom: 26px;">
                  <div class="col">
                    <div class="custom-file">
                      <label class="custom-file-label" for="file-upload" style="white-space: nowrap;overflow: hidden;text-overflow: clip;">Pilih file</label>
                      <input type="file" id="file" style="cursor: pointer;" class="custom-file-input" id="file-upload" multiple>
                    </div>
                  </div>
                </div>

                <div class="form-row" id="error-file" style="margin-left: 3px;margin-top: 10px;margin-right: 3px; margin-bottom: -3px; display: none;">
                  <div class="col">
                    <div class="alert alert-danger" role="alert" style="padding: 0 3px 0 5px; margin-top: -22px;margin-bottom: 5px; font-size: 12px;">
                      Error Upload
                    </div>
                  </div>
                </div>

                <div class="table-responsive table">
                  <div class="col">
                    <table id="user_table" class="table display nowrap" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Email</th>
                          <th style="text-align: center;">
                            <div id="pop" data-container="body" data-trigger="manual" data-toggle="popover" data-placement="top" data-content="Pilih Alamat Email Pengiriman">
                              <label for="allcheck" style="-moz-user-select: none;user-select: none; padding-bottom: 0;margin-bottom: 0; cursor: pointer;">Pilih</label>
                              <input type="checkbox" id="allcheck" style="cursor: pointer;">
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="tabels">

                        <?php
                        $data = $data['dataUsers'];
                        $index = 0;
                        foreach ($data as $row) {
                          $index++;
                          echo '
                            <tr>
                              <td>' . $row["name"] . '</td>
                              <td>' . $row["email"] . '</td>
                              <td>
                                    <div style="text-align: center;">
                                        <input style="cursor: pointer;" type="checkbox" name="single_select" class="single_select" data-email="' . $row["email"] . '" data-name="' . $row["name"] . '" />
                                    </div>

                              </td>
                            </tr>
                            ';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-row" id="msg-send" style="margin-left: 6px;margin-right: 6px; margin-bottom: 5px;margin-top: -7px; display: none;">
                  <div class="col">
                    <div class="alert" role="alert" style="padding: 0 3px 0 5px; margin-top: -12px;margin-bottom: 0; font-size: 12px;word-break: break-all;">
                      Send Message
                    </div>
                  </div>
                </div>

                <div class="form-row" id="submit-btn">
                  <div class="col center">
                    <div class="form-group" style="margin-bottom: 10px;">
                      <button type="button" id="btn-send" class="btn btn-primary">
                        <i class="fa fa-send" style="margin-right: 10px;"></i>Kirim Pesan
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include_once "_partials/footer.php" ?>
    </div>
  </div>

  <?php include_once "_partials/scripts.php" ?>
  <script src="../../assets/js/bulk-mailer.js"></script>
</body>

</html>