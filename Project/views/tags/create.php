<?php $this->title = 'Create New Tag'; ?>

<h1><?= htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Tag name:</div>
    <input type="text" name="tag_name" />

    <div><input type="submit" value="Create" />
        <a href="<?=APP_ROOT?>/tags">[Cancel]</a>
    </div>
</form>