<?php foreach ($users as $row) : ?>
    <tr>
        <td><?= ($all) ? $row["fullname"] : $row[0]["fullname"] ?></td>
        <td><?= ($all) ? $row["email"] : $row[0]["email"] ?></td>
        <td>
            <div class="text-center">
                <input style="cursor: pointer;" type="checkbox" name="single_select" class="single_select" data-email='<?= $row["email"] ?>' data-name='<?= $row['fullname'] ?>' />
            </div>
        </td>
    </tr>
<?php endforeach; ?>