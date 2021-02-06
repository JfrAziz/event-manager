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
            <a class="btn btn-danger btn-sm d-none d-sm-inline-block" role="button" href="https://github.com/K-Kraken/REMS-For-Organisations/issues" style="background-color: #ce1126;border-color: #e5053a;">
              <i class="fas fa-bug fa-sm text-white-50"></i>&nbsp;Raise a Issue
            </a>
          </div>

          <div class="row">
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                        <span>Registrations for <?= ucwords(str_replace("event ", "", (str_replace("_", " ", $event_table)))); ?> (Latest)</span>
                      </div>
                      <div class="text-dark font-weight-bold h5 mb-0">
                        <span>$registrationCount</span>
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
              <div class="card shadow border-left-success py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-success font-weight-bold text-xs mb-1">
                        <span>Total Members</span>
                      </div>
                      <div class="text-dark font-weight-bold h5 mb-0">
                        <span>37</span>
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
              <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                        <span>Events conducted so far</span>
                      </div>
                      <div class="text-dark font-weight-bold h5 mb-0">
                        <span><?= $events_count; ?></span>
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
          <div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="text-primary m-0 font-weight-bold">Let's get started</h6>
                </div>
                <div class="card-body">
                  <p class="m-0">
                    This is a software application to reduce amount of menial work we do. We know it is a tedious process to manually make forms, certificates, advertising via mail so we decided to automate that process. I guess it's all pretty
                    self explainatory. Knock yourself out<br>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="text-primary m-0 font-weight-bold">Send Alerts&nbsp;<i class="fa fa-send"></i></h6>
                    </div>
                    <div class="card-body">
                      <p class="m-0" style="padding-bottom: 10px;">
                        You can send alerts to all from here through the alert center. You username would be attached to your message.<br />
                      </p>
                      <form method="POST" action="db-ops/pushAlert.php">

                        <div class="form-group">
                          <input type="text" class="form-control btn-sm" placeholder="Enter the message to be sent" name="alertMessage" />
                        </div>
                        <div class="form-group">
                          <input type="submit" class="form-control btn btn-primary btn-sm" />
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div id="newCol" class=""></div>
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