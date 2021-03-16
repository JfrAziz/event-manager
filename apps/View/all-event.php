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
          <?php foreach ($data as $item) : ?>
            <div class="card shadow py-2 my-3">
              <div class="card-body">
                <div class="row align-items-center no-gutters">
                  <div class="col mr-2">
                    <div class="text-uppercase text-custom-primary font-weight-bold mb-1">
                      <span><?= $item['name'] ?></span>
                    </div>
                    <div class="text-dark text-sm mb-0">
                      <span><?= $item['description']  ?></span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php include_once "_partials/footer.php" ?>
    </div>
  </div>
  <?php include_once "_partials/scripts.php" ?>
</body>

</html>