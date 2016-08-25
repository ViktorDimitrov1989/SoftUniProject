<?php $this->title = 'Edit Existing Category';

?>

<h1><?= htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Title:</div>
    <input type="text" name="category_name" value="<?=
    htmlspecialchars($this->category['category_name'])?>"/>
    <div>Content:</div>
    <textarea rows="10" name="category_description"><?=
        htmlspecialchars($this->category['category_description'])?></textarea>

    <!--<div>Author ID:
    <select name="user_id">
        <?php /*$ids = $this->model->getAllId();
            foreach ($ids as $id):*/?>
        <option value="<?/*= $id['id'] */?>"><?/*=$id['id']*/?></option>
        <?php /*endforeach;*/?>
    </select>-->
    <!--</div>-->
    <div><input type="submit" value="Edit"/>
        <a href="<?=APP_ROOT?>/categories/view">[Cancel]</a></div>
</form>

<!--The form is incredibly similar to the delete form, -->
<!--except this time everything is enabled and we can freely change it. -->
<!--When the edit form is submitted, -->
<!--it will override the old data in the Database with the newly given values. -->
