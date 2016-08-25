<?php $this->title = 'Edit Existing Topic';

?>

<h1><?= htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Subject:</div>
    <input type="text" name="topic_subject" value="<?=
    htmlspecialchars($this->topic['topic_subject'])?>"/>

    <div>Tag:
        <select name="tag_name">
            <?php $tags = $this->model->tags();
            foreach ($tags as $tag):?>
                <option value="<?= $tag['name'] ?>"><?=$tag['name']?></option>
            <?php endforeach;?>
        </select></div>

    <div><input type="submit" value="Edit"/>
        <a href="<?=APP_ROOT?>/topics">[Cancel]</a></div>
</form>

<!--The form is incredibly similar to the delete form, -->
<!--except this time everything is enabled and we can freely change it. -->
<!--When the edit form is submitted, -->
<!--it will override the old data in the Database with the newly given values. -->
