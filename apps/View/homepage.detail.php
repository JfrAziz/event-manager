<!DOCTYPE html>
<html>

<?php include_once "_partials/head.php" ?>

<body>
  <main id="main">
    <section id="content" class="content">
      <?php include_once "_partials/header.public.php" ?>
      <div class="container">
        <div class="container-fluid">

          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Selamat Datang!</h3>

          </div>
          <div>
            <div class="card shadow">
              <div class="card-header py-3">
                <p class="text-custom-primary m-0 font-weight-bold">Detail</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col m-3">
                    <div class="row font-weight-bold">
                      Nama Acara
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
                      Deskripsi Acara
                    </div>
                    <div class="row" style="text-align: justify;">
                      <span><?= htmlspecialchars_decode(stripslashes($data['description'])); ?></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col m-3">
                    <div class="row font-weight-bold">
                      Pembuat Acara
                    </div>
                    <div class="row">
                      <span><?= $data['fullname'] ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once "_partials/footer.public.php" ?>
    </section>
  </main>
  <?php include_once "_partials/scripts.php" ?>
</body>

</html>