<?php if (count($users) !== 0) {
    $index = 0;
    foreach ($users as $row) : ?>
        <?php $index++; ?>
        <tr class="<?= ($index % 2 == 0) ? "even" : "odd"; ?>">
            <td class="sorting_1"><?= $row["fullname"] ?></td>
            <td><?= $row["email"] ?></td>
            <td>
                <div class="text-center">
                    <input style="cursor: pointer;" type="checkbox" name="<?= 'select-' . $row["id"]; ?>" class="single_select" data-checked="<?= $ischecked["select-" . $row["id"]]; ?>" data-email='<?= $row["email"] ?>' data-name='<?= $row['fullname'] ?>'>
                </div>
            </td>
        </tr>
    <?php endforeach;
} else { ?>
    <tr class="odd">
        <td valign="top" colspan="3" class="dataTables_empty">Data kosong</td>
    </tr>
<?php } ?>