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
              <p class="text-primary m-0 font-weight-bold">Email Massal</p>
            </div>
            <div class="card-body m-3">
              <div style="display: flex; justify-content: space-between; align-items: center;margin: 0 -10px 20px -10px" id="select-event">
                <label for="event-name" style="margin-top: 10px;">Pilih User Berdasarkan Event :</label>
                <select class="custom-select" id="event-name">
                  <option selected value="all">Semua</option>
                  <?php foreach ($events as $event) : ?>
                    <option value="<?= $event['id']; ?>"><?= $event['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <form method="POST" action="send.php" id="form" enctype="multipart/form-data" style="margin-left: -10px; margin-right: -10px;">
                <div class="form-row" id="subject">
                  <div class="col">
                    <div class="form-group" style="margin-bottom: 25px;">
                      <input class="form-control" type="text" placeholder="Subjek" name="mail_subject">
                    </div>
                  </div>
                </div>
                <div class="form-row" id="body">
                  <div class="col">
                    <div class="form-group" style="margin-bottom: 25px;">
                      <textarea class="form-control" placeholder="Pesan" style="height: 100px;" name="mail_body" id="mail_body"></textarea>
                    </div>
                  </div>
                </div>
                <div id="error-msg" class="alert alert-danger alert-dismissible d-none" role="alert" style="padding: 0 10px 0 10px; margin: -22px 0 3px 0;">
                  <div style="font-size: 14px;"><strong>Pesan</strong> Harus Diisi.</div>
                  <button type="button" onclick="$('#error-msg').addClass('d-none')" class="close" aria-label="Close" style="padding: 0 8px 0 8px; margin-top: -5px; outline: none;">
                    <span aria-hidden="true" style="font-size: 20px;">&times;</span>
                  </button>
                </div>
                <div class="form-row" id="file-body" style="margin: 0 -5px 25px -5px;">
                  <div class="col">
                    <div class="custom-file">
                      <label class="custom-file-label" for="file-upload" style="white-space: nowrap;overflow: hidden;text-overflow: clip;">Pilih file</label>
                      <input type="file" id="file" style="cursor: pointer;" class="custom-file-input" id="file-upload" multiple>
                    </div>
                  </div>
                </div>
                <div id="error-file" class="alert alert-danger alert-dismissible d-none" role="alert" style="padding: 0 25px 0 10px; margin: -22px 0 0 0;">
                  <div style="font-size: 14px; overflow-wrap: break-word; text-align: justify;">Error Upload.</div>
                  <button type="button" onclick="$('#error-file').addClass('d-none')" class="close" aria-label="Close" style="padding: 0 8px 0 8px; margin-top: -5px; outline: none;">
                    <span aria-hidden="true" style="font-size: 20px;">&times;</span>
                  </button>
                </div>

                <div class="table-responsive table">
                  <div class="col px-1">
                    <table id="user_table" class="table display nowrap" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Email</th>
                          <th class="text-center" style="-moz-user-select: none;user-select: none;">
                            <div id="pop" data-container="body" data-trigger="manual" data-toggle="popover" data-placement="top" data-content="Pilih Alamat Email Pengiriman">
                              <label for="allcheck" class="pb-0 mb-0 mr-2" style="cursor: pointer;">Pilih Semua</label>
                              <input type="checkbox" data-checked="false" id="allcheck" style="cursor: pointer;">
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($user_data as $row) : ?>
                          <tr>
                            <td><?= $row["fullname"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td>
                              <div class="text-center">
                                <input style="cursor: pointer;" type="checkbox" name="<?= 'select-' . $row["email"]; ?>" class="single_select" data-checked="false" data-email='<?= $row["email"] ?>' data-name='<?= $row['fullname'] ?>'>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div id="msg-send" class="alert btn-success alert-dismissible d-none" role="alert" style="padding: 0 25px 0 10px; margin: -15px 0 3px 0;">
                  <div style="font-size: 14px; overflow-wrap: break-word;">Pesan Pengiriman</div>
                  <button type="button" onclick="$('#msg-send').addClass('d-none')" class="close" aria-label="Close" style="padding: 0 8px 0 8px; margin-top: -5px; outline: none;">
                    <span aria-hidden="true" style="font-size: 20px;">&times;</span>
                  </button>
                </div>
                <div class="form-row" id="submit-btn">
                  <div class="col center">
                    <div class="form-group mb-3">
                      <button type="button" id="btn-send" class="btn btn-custom-primary text-white">
                        <i class="fa fa-send mr-3"></i>Kirim Pesan
                      </button>
                      <button style="position: relative;" class="btn btn-custom-primary text-white btn-loading d-none" type="button" disabled>
                        <span style="position: absolute; left: 10px; top: 10px;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <div style="padding-left: 22px;">Mengirim...</div>
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
</body>
<script src="<?= base_url('assets/js/bulk-mailer.js'); ?>"></script>

</html>