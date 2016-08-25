<?php $this->title = 'Delete Category'; ?>

<h1>Are you sure you want to delete this category?</h1>

<form method="post">
    <div>Title:</div><input type="text" value="<?=
    htmlspecialchars($this->category['category_name'])?>" disabled/>
    <div>Content:</div>
    <textarea rows="10" disabled><?=
        htmlspecialchars($this->category['category_description'])?></textarea>

    <!--<div>Author ID</div><input type="text" value="<?/*=
     htmlspecialchars($this->post['user_id'])*/?>"disabled />-->
    <div><input type="submit" value="Delete"/>
        <a href="<?=APP_ROOT?>/categories/view">[Cancel]</a></div>
</form>