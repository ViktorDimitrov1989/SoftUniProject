<?php $this->title = 'Users';?>

<h1><?= htmlspecialchars($this->title)?></h1>

<?php /*var_dump($this->users) */?>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Actions</th>
    </tr>
<?php foreach ($this->users as $user) : ?>
    <tr>
        <td><?= $user['id']?></td>
        <td><?= $user['username']?></td>
        <td><?= $user['full_name']?></td>

    <td>
    <?php if ($_SESSION['role'] == "Administrator") : ?>

        <a href="<?=APP_ROOT?>/users/edit/<?= $user['id']?>">[Edit]</a>
        <?php if ($this->model->status($user['username']) == 1) :?>
            <a href="<?=APP_ROOT?>/users/block/<?= $user['id']?>">[Block]</a>
        <?php else: ?>
            <a href="<?=APP_ROOT?>/users/unblock/<?= $user['id']?>">[Unblock]</a>
        <?php endif; ?>
    </td>
        <?php endif; ?>
    </tr>
<?php endforeach;?>
</table>
