<?php $this->title = 'Create New Post'; ?>

<h1><?= htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Title:</div>
    <input type="text" name="post_title" />
    <div>Content:</div>
    <textarea  rows="10" name="post_content"></textarea>
    
    
    <div>Tags: </div>
    <!--<input type="text" name="tag_name"/>-->
    <select name="tag_name">
   <?php $tags = $this->model->tags();
    foreach ($tags as $tag):?>
        <option value="<?= $tag['name'] ?>"><?=$tag['name']?></option>
    <?php endforeach;?>
    </select>


    <div><input type="submit" value="Create" />
        <a href="<?=APP_ROOT?>/posts">[Cancel]</a>
    </div>
</form>

