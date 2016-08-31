<?php $this->title = 'Edit Existing Tag'; ?>

<h1><?= htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Name:</div>
    <input type="text" name="tag_name" value="<?=
    htmlspecialchars($this->tag['name'])?>"/>

    <div><input type="submit" value="Edit"/>
        <a href="<?=APP_ROOT?>/tags">[Cancel]</a></div>
</form>