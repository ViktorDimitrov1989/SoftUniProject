<?php $this->title = 'Edit Existing Post'; ?>

<h1><?= htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Title:</div>
    <input type="text" name="post_title" value="<?=
    htmlspecialchars($this->post['title'])?>"/>
    <div>Content:</div>
    <textarea rows="10" name="post_content"><?=
        htmlspecialchars($this->post['content'])?></textarea>
    <div>Date (yyyy-MM-dd hh:mm:ss):</div>
    <input type="text" name="post_date" value="<?=
    htmlspecialchars($this->post['date'])?>"/>
    <!--<div>Author ID:
    <select name="user_id">
        <?php /*$ids = $this->model->getAllId();
            foreach ($ids as $id):*/?>
        <option value="<?/*= $id['id'] */?>"><?/*=$id['id']*/?></option>
        <?php /*endforeach;*/?>
    </select>-->
    <!--</div>-->
    <div><input type="submit" value="Edit"/>
        <a href="<?=APP_ROOT?>/posts/view">[Cancel]</a></div>
</form>

<!--The form is incredibly similar to the delete form, -->
<!--except this time everything is enabled and we can freely change it. -->
<!--When the edit form is submitted, -->
<!--it will override the old data in the Database with the newly given values. -->
