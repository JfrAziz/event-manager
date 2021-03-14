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
            <div class="card-body m-3">
              <form method="POST" action="send.php" id="form" enctype="multipart/form-data">
                <div class="form-row" id="subject">
                  <div class="col">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="Subjek" name="mail_subject">
                    </div>
                  </div>
                </div>
                <div class="form-row" id="body">
                  <div class="col">
                    <div class="form-group">
                      <textarea class="form-control" placeholder="Pesan" style="height: 100px;" name="mail_body" id="mail_body"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-row my-3 d-none" id="error-msg">
                  <div class="col">
                    <div class="alert alert-danger" role="alert" style="font-size: 12px;">
                      Pesan Harus Diisi
                    </div>
                  </div>
                </div>

                <div class="form-row my-3 " id="file-body">
                  <div class="col">
                    <div class="custom-file">
                      <label class="custom-file-label" for="file-upload" style="white-space: nowrap;overflow: hidden;text-overflow: clip;">Pilih file</label>
                      <input type="file" id="file" style="cursor: pointer;" class="custom-file-input" id="file-upload" multiple>
                    </div>
                  </div>
                </div>

                <div class="form-row my-3 d-none" id="error-file">
                  <div class="col">
                    <div class="alert alert-danger" role="alert" style="font-size: 12px;">
                      Error Upload
                    </div>
                  </div>
                </div>

                <div class="table-responsive table">
                  <div class="col px-1">
                    <table id="user_table" class="table display nowrap" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Email</th>
                          <th class="text-center" style="-moz-user-select: none;user-select: none; cursor: pointer;">
                            <div id="pop" data-container="body" data-trigger="manual" data-toggle="popover" data-placement="top" data-content="Pilih Alamat Email Pengiriman">
                              <label for="allcheck" class="pb-0 mb-0 mr-2">Pilih Semua</label>
                              <input type="checkbox" id="allcheck">
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody id="tabels">
                        <?php foreach ($user_data as $row) : ?>
                          <tr>
                            <td><?= $row["fullname"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td>
                              <div class="text-center"">
                                <input style="cursor: pointer;" type="checkbox" name="single_select" class="single_select" data-email='<?= $row["email"] ?>' data-name='<?= $row['fullname'] ?>' />
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-row" id="submit-btn">
                  <div class="col center">
                    <div class="form-group mb-3">
                      <button type="button" id="btn-send" class="btn btn-primary">
                        <i class="fa fa-send mr-3"></i>Kirim Pesan
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
  <script src="<?= base_url("assets/js/bulk-mailer.js") ?>"></script>
</body>

</html>