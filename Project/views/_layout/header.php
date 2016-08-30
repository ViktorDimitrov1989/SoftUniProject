<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?=APP_ROOT?>/content/styles.css" />
    <link rel="icon" href="<?=APP_ROOT?>/content/images/favicon.ico" />
    <script src="<?=APP_ROOT?>/content/scripts/jquery-3.0.0.min.js"></script>
    <script src="<?=APP_ROOT?>/content/scripts/blog-scripts.js"></script>
    <title><?php if (isset($this->title)) echo htmlspecialchars($this->title) ?></title>
</head>

<body>
<header>
    <a href="<?=APP_ROOT?>"><img width="120px" src="<?=APP_ROOT?>/content/images/forum_logo.png"></a>
    <a href="<?=APP_ROOT?>/">Home</a>
    <?php if ($this->isLoggedIn) : ?>
        <a href="<?=APP_ROOT?>/topics">Topics</a>
        <a href="<?=APP_ROOT?>/topics/create">Create Topic</a>

        <a href="<?=APP_ROOT?>/users/edit_your_profile">Edit your profile</a>

        <a href="<?=APP_ROOT?>/posts/view">Your Posts</a>
        
        <?php if ($_SESSION['role'] == "Administrator") {?>
            <b>Admin panel: </b>
            <a href="<?=APP_ROOT?>/users">Users</a>
            <a href="<?=APP_ROOT?>/categories">Categories</a>
        <?php } ?>
    
    <?php else: ?>
        <a href="<?=APP_ROOT?>/users/login">Login</a>
        <a href="<?=APP_ROOT?>/users/register">Register</a>
    <?php endif; ?>

    <?php if ($this->isLoggedIn) : ?>
        <div id="logged-in-info">
            <span>Hello, <b><?=htmlspecialchars($_SESSION['username'])?></b></span>
            <form method="post" action="<?=APP_ROOT?>/users/logout">
                <input type="submit" value="Logout"/>
            </form>
            <br>
            <span><b>Your rank is: <?= $_SESSION['rank']?></b></span>
        </div>
    <?php endif; ?>
</header>

<?php require_once('show-notify-messages.php'); ?>
