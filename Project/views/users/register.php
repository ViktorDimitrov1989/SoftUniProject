<?php $this->title = 'Register New User'; ?>

<h1><?= htmlspecialchars($this->title) ?></h1>

<!-- TODO: register form will come here ... -->
<form method="post">
    <div><label for="username">Username:</label></div>
    <input id="username" type="text" name="username">
    <div><label for="password">Password:</label></div>
    <input id="password" type="password" name="password">
    <div><label for="password">Confirm Password:</label></div>
    <input id="confirm_password" type="password" name="confirm_password">
    <div><label for="username">Email:</label></div>
    <input id="email" type="email" name="email">
    <div><label for="email">Full name:</label></div>
    <input id="full_name" type="text" name="full_name">
        <div><input type="submit" value="Register"></div>
        <div><a href="<?=APP_ROOT?>/users/login">[Go to login]</a></div>
</form>