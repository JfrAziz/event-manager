<?php if (count($data) !== 0) : ?>

    <?php foreach ($data as $item) : ?>
        <a href="<?= base_url("e/{$item['id']}") ?>">
            <div class="card shadow py-2 my-3">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase text-custom-primary font-weight-bold mb-1">
                                <span><?= $item['name'] ?></span>
                            </div>
                            <div class="text-dark text-sm mb-0" style="text-align: justify;">
                                <span><?= htmlspecialchars_decode(stripslashes($item['description'])); ?></span>
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
<?php else : ?>

    <div class="card shadow py-2 my-3">
        <div class="card-body">
            <div class="row align-items-center no-gutters">
                <div class="col mr-2" style="display: flex; justify-content: center; font-weight: bold;">
                    Acara Tidak Ditemukan
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>