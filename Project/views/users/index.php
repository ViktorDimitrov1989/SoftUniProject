<?php $this->title = 'Users';?>

<h1><?= htmlspecialchars($this->title)?></h1>

<?php /*var_dump($this->users) */?>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Full Name</th>
    </tr>
<?php foreach ($this->users as $user) : ?>
    <tr>
        <td><?= $user['id']?></td>
        <td><?= $user['username']?></td>
        <td><?= $user['full_name']?></td>
    </tr>
<?php endforeach;?>
</table>
