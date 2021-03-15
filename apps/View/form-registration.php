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
            <h3 class="text-dark mb-0">View Responses</h3>
          </div>
          <div class="row">
            <div class="col-md-9 mb-4">
              <form action="" method="GET">
                <select onchange="this.form.submit()" class="form-control border-1 small" style="width: 68%;max-width:15em;" name="event" required>
                  <option value="">Select an event</option>
                  <?php foreach ($eventNames as $row) : ?>
                    <option value=<?= $row["Tables_in_" . $formDB] . ucwords(str_replace("event ", "", (str_replace("_", " ", $row["Tables_in_" . $formDB])))) ?> />
                    </option>
                  <?php endforeach; ?>
                </select><br>
              </form>
            </div>
            <div class="col-md-3 mb-4">
              <div class="card shadow border-left-success py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Total Responses</span></div>
                      <div class="text-dark font-weight-bold h5 mb-0">
                        <span>
                          <?= isset($countr) ? $countr : "No event chosen" ?>
                        </span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card shadow">
            <div class="card-header py-3">
              <p class="text-custom-primary m-0 font-weight-bold"><?= ucwords(str_replace("event ", "", (str_replace("_", " ", $event)))); ?></p>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 text-nowrap">
                  <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                    <label>
                      <form action="/member/form/reg" method="GET">
                        <input type="hidden" name="event" value="<?= $event; ?>" />
                        <input type="hidden" name="page" value="1" />
                        <select onchange="this.form.submit()" name="perPage" class="form-control form-control-sm custom-select custom-select-sm">
                          <option value="10" <?php if ($per_page == 10) : ?> selected <?php endif; ?>>10</option>
                          <option value="25" <?php if ($per_page == 25) : ?> selected <?php endif; ?>>25</option>
                          <option value="50" <?php if ($per_page == 50) : ?> selected <?php endif; ?>>50</option>
                          <option value="100" <?php if ($per_page == 100) : ?> selected <?php endif; ?>>100</option>
                        </select>
                      </form>
                    </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="text-md-right dataTables_filter" id="dataTable_filter">
                    <label>
                      <input type="search" name="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search Name">
                    </label>
                  </div>
                </div>
              </div>
              <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table dataTable my-0" id="dataTable">
                  <thead>
                    <tr>
                      <?php if (!(empty($_GET['event']))) : ?>
                        <?php foreach ($colArr as $col) : ?>
                          <th><?= $display_prompts[$col] ?></th>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!(empty($_GET['event']))) : ?>
                      <?php foreach ($registrants as $row) : ?>
                        <tr><?= ucwords($row[$col])  ?></tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <?php if (!(empty($_GET['event']))) : ?>
                        <?php foreach ($colArr as $col) : ?>
                          <th><?= $display_prompts[$col] ?></th>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="row">
                <div class="col-md-6 align-self-center">
                  <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite"></p>
                </div>
                <form class="col-md-6">
                  <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                      <li class="page-item <?php if ($page == 1) : ?> disabled <?php endif; ?>">
                        <button name="page" value="<?= ($page - 1); ?>" class="page-link" aria-label="Previous">
                          <span aria-hidden="true">«</span>
                        </button>
                      </li>
                      <input type="hidden" name="event" value="<?= $_GET['event']; ?>" />
                      <input type="hidden" name="perPage" value="<?= $per_page; ?>" />
                      <?php for ($x = 1; $x <= $total_pages; $x++) : ?>
                        <?php if ($x == $page) : ?>
                          <li class="page-item active"><button name="page" value="<?= $x; ?>" class="page-link"><?= $x; ?></button></li>
                        <?php else : ?>
                          <li class="page-item"><button name="page" value="<?= $x; ?>" class="page-link"><?= $x; ?></button></li>
                        <?php endif; ?>
                      <?php endfor; ?>
                      <li class="page-item <?php if ($page == $total_pages) : ?> disabled <?php endif; ?>">
                        <button name="page" value="<?= ($page + 1); ?>" class="page-link" aria-label="Next">
                          <span aria-hidden="true">»</span>
                        </button>
                      </li>
                    </ul>
                  </nav>
                </form>
              </div>

            </div>
          </div>
        </div>
        <br><br>
      </div>
      <?php include_once "_partials/footer.php" ?>
    </div>
  </div>
  <?php include_once "_partials/scripts.php" ?>
</body>

</html>