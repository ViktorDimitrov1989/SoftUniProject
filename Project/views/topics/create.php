<?php $this->title = 'Create New Topic'; ?>

<h1><?= htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Title:</div>
    <input type="text" name="topic_title"/>

    <div>Category:

    <select name="category_id">
        <?php $categories = $this->model->categories();
        foreach ($categories as $category):?>
            <option value="<?= $category['category_id'] ?>"><?=$category['category_name']?></option>
        <?php endforeach;
        ?>
    </select>
    </div>
    
    <div>Tag:
        
    <select name="tag_name">
        <?php $tags = $this->model->tags();

        foreach ($tags as $tag):?>
            <option value="<?= $tag['name'] ?>"><?=$tag['name']?></option>
        <?php endforeach;?>
    </select></div>

    <div><input type="submit" value="Create" />
        <a href="<?=APP_ROOT?>/categories">[Cancel]</a>
    </div>
</form>

