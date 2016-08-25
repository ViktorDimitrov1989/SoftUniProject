<?php $this->title = 'Create New Category'; ?>

<h1><?= htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Title:</div>
    <input type="text" name="category_title"/>
    <div>Content:</div>
    <textarea  rows="10" name="category_content"></textarea>


   <!--<input type="text" name="tag_name"/>-->



    <div><input type="submit" value="Create" />
        <a href="<?=APP_ROOT?>/categories">[Cancel]</a>
    </div>
</form>

