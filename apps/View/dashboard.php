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
            <h3 class="text-dark mb-0">Welcome!</h3>
          </div>

          <div class="row">
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="card shadow py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-custom-primary font-weight-bold text-xs mb-1">
                        <span>Registrations for ..</span>
                      </div>
                      <div class="text-dark font-weight-bold h5 mb-0">
                        <span><?= $form_count[0]['count']; ?></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="card shadow py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                        <span>Total Members</span>
                      </div>
                      <div class="text-dark font-weight-bold h5 mb-0">
                        <span><?= $member_count[0]['count']; ?></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-ninja fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="card shadow py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-custom-primary font-weight-bold text-xs mb-1">
                        <span>Events conducted so far</span>
                      </div>
                      <div class="text-dark font-weight-bold h5 mb-0">
                        <span><?= $event_count[0]['count']; ?></span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
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