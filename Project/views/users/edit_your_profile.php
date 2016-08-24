<?php $this->title = 'Edit user details'; ?>

<h1><?= htmlspecialchars($this->title)?></h1>

<?php /*var_dump($this->post)*/?><!--<br>
<?php /*var_dump($this->model->getPass($_SESSION['user_id'])['password_hash'])*/?><br>-->

<form method="post">
<!--    <div>Username:</div>
    <input type="text" name="username" value="<?/*=
    htmlspecialchars($this->post['username'])*/?>"/>-->
    <div>Full Name:</div>
    <input type="text" name="full_name" value="<?=
    htmlspecialchars($this->post['full_name'])?>"/>
    <div>Email:</div>
    <input type="text" name="email" value="<?=
    htmlspecialchars($this->post['email'])?>"/>

    <div>Old password:</div>
    <input type="text" name="old_pass"/>
    
    <div>New password:</div>
    <input type="text" name="nPass"/>
    <div>Repeat new password:</div>
    <input type="text" name="repPass"/>

    <div><input type="submit" value="Edit"/>
        <a href="<?=APP_ROOT?>/">[Cancel]</a></div>
</form>
