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
            <h3 class="text-dark mb-0">Welcome!</h3>

          </div>
          <div>
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
      </div>
      <?php include_once "_partials/footer.public.php" ?>
    </section>
  </main>
  <?php include_once "_partials/scripts.php" ?>
</body>

</html>