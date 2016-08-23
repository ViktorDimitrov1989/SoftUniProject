<?php $this->title = 'Edit user details'; ?>

<h1><?= htmlspecialchars($this->title)?></h1>

<?php /*var_dump($this->post)*/?>

<form method="post">
    <div>Username:</div>
    <input type="text" name="username" value="<?=
    htmlspecialchars($this->post['username'])?>"/>
    <div>Full Name:</div>
    <input type="text" name="full_name" value="<?=
        htmlspecialchars($this->post['full_name'])?>"/>
    <div>Email:</div>
    <input type="text" name="email" value="<?=
    htmlspecialchars($this->post['email'])?>"/>
    <div>Set role:</div>
    <select name="roles">
        <?php $roles = $this->model->getAllRoles();
            foreach ($roles as $role):?>
        <option value="<?= $role['id'] ?>"><?=$role['role_name']?></option>
        <?php endforeach;?>
    </select>
    

    <div><input type="submit" value="Edit"/>
        <a href="<?=APP_ROOT?>/users">[Cancel]</a></div>
</form>
