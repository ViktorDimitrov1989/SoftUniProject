<?php $this->title = 'Delete Tag'; ?>

<h1>Are you sure you want to delete this tag?</h1>

<form method="post">
    <div>Name:</div><input type="text" value="<?=
    htmlspecialchars($this->tag['name'])?>" disabled/>

    <div><input type="submit" value="Delete"/>
        <a href="<?=APP_ROOT?>/tags">[Cancel]</a></div>
</form>