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
          <div class="row">
            <div class="col col-md-9">
              <div class="card shadow">
                <div class="card-header py-3">
                  <p class="text-custom-primary m-0 font-weight-bold">Detail</p>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col m-3">
                      <div class="row font-weight-bold">
                        Tanggal Event
                      </div>
                      <div class="row">
                        <span><?= $data['name'] ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col m-3">
                      <div class="row font-weight-bold">
                        Tanggal Acara
                      </div>
                      <div class="row">
                        <span><?= (new DateTime($data['start_time']))->format('d M Y G:i') ?> hingga <?= (new DateTime($data['end_time']))->format('d M Y G:i') ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col m-3">
                      <div class="row font-weight-bold">
                        Deskripsi Envent
                      </div>
                      <div class="row">
                        <span><?= htmlspecialchars_decode(stripslashes($data['description'])); ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col m-3">
                      <div class="row font-weight-bold">
                        Pembuat Event
                      </div>
                      <div class="row">
                        <span><?= $data['fullname'] ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col col-md-3">
              <div class="card shadow">
                <div class="card-header py-3">
                  <p class="text-custom-primary m-0 font-weight-bold">Regritrasi</p>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <?php if ($data['user_id'] != $_SESSION['id']) : ?>
                        <form action="<?= base_url("/member/event/register") ?>" method="post">
                          <input type="hidden" name="event_id" value="<?= $data['id'] ?>">
                          <?php if (!$registered) : ?>
                            <input type="submit" value="REGISTER" class="btn btn-primary col">
                          <?php else : ?>
                            <span>Anda sudah terdaftar</span>
                          <?php endif; ?>
                        </form>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
        <?php include_once "_partials/footer.php" ?>
      </div>
    </div>

  </div>
  <?php include_once "_partials/scripts.php" ?>
</body>

</html>