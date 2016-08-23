<?php $this->title = 'Block User'; ?>

<h1>Are you sure you want to block this user?</h1>

<form method="post">
    <div>Username:</div>
    <input type="text" name="username" value="<?=
    htmlspecialchars($this->post['username'])?>" disabled/>
    <div>Full Name:</div>
    <input type="text" name="full_name" value="<?=
    htmlspecialchars($this->post['full_name'])?>" disabled/>
    <div>Email:</div>
    <input type="text" name="email" value="<?=
    htmlspecialchars($this->post['email'])?>" disabled/>
    <div><input type="submit" value="Block"/>
        <a href="<?=APP_ROOT?>/users/index">[Cancel]</a></div>
</form>