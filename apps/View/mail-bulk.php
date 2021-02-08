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
            <div class="card-body">
              <form action="" method="post">
                <div class="form-row" id="choose-list" style="margin-left: 10px;margin-top: 0px;margin-right: 10px;padding-top: 0px;">
                  <div class="col">
                    <select name="mailing_list" class="form-control border-1 small" style="width:40%">
                      <option disabled selected>Select Mailing list</option>
                    </select>
                  </div>
                </div>
                <div class="form-row" id="subject" style="margin-left: 10px;margin-top: 14px;margin-right: 10px;">
                  <div class="col">
                    <div class="form-group">
                      <input class="form-control form-control" type="text" placeholder="Subject" required="" name="mail_subject">
                    </div>
                  </div>
                </div>
                <div class="form-row" id="subject" style="margin-left: 10px;margin-top: 14px;margin-right: 10px;">
                  <div class="col">
                    <div class="form-group">
                      <input class="form-control form-control" type="text" placeholder="Title of the E-mail" required="" name="mail_title" id="mail_title">
                    </div>
                  </div>
                </div>
                <div class="form-row" id="subject" style="margin-left: 10px;margin-top: 14px;margin-right: 10px;">
                  <div class="col">
                    <div class="form-group">
                      <input class="form-control form-control" type="text" placeholder="Button label" required="" name="mail_button_label" id="mail_button_label" value="">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <input class="form-control form-control" type="text" placeholder="Button URL" required="" name="mail_button_url" id="mail_button_url" value="">
                    </div>
                  </div>
                </div>
                <div class="form-row" id="subject" style="margin-left: 10px;margin-top: 14px;margin-right: 10px;">
                  <div class="col">
                    <div class="form-group">
                      <input class="form-control form-control" type="text" placeholder="Logo URL" required="" name="mail_logo_url" id="mail_logo_url" value="">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <input class="form-control form-control" type="text" placeholder="Cover Image URL" required="" name="mail_coverimg_url" id="mail_coverimg_url" value="">
                    </div>
                  </div>
                </div>
                <div class="form-row" id="body" style="margin-left: 10px;margin-top: 14px;margin-right: 10px;">
                  <div class="col">
                    <div class="form-group">
                      <textarea class="form-control form-control" placeholder="Mail Body" required="" style="height: 350px;min-height: 250px;" name="mail_body" id="mail_body"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-row" id="submit-btn" style="margin-left: 10px;margin-top: 14px;margin-right: 10px;">
                  <div class="col center">
                    <div class="form-group">
                      <button class="btn btn-primary" type="submit" name="submit">&nbsp;
                        <i class="fa fa-send"></i>&nbsp; &nbsp; &nbsp;Send Message&nbsp; &nbsp;
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

</html>