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
          <?php if (empty($data)) : ?>
            <div class="text-center font-italic">
              Belum ada event yang dibuat
            </div>
          <?php endif; ?>
          <?php foreach ($data as $item) : ?>
            <a href="<?= base_url("/member/event/{$item['id']}") ?>">
              <div class="card shadow py-2 my-3">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-custom-primary font-weight-bold mb-1">
                        <span><?= $item['name'] ?></span>
                      </div>
                      <div class="text-dark text-sm mb-0">
                        <?= htmlspecialchars_decode(stripslashes($item['description'])); ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php include_once "_partials/footer.php" ?>
    </div>
  </div>
  <?php include_once "_partials/scripts.php" ?>
</body>

</html>