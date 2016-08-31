<?php $this->title = 'Delete Topic'; ?>

<h1>Are you sure you want to delete this topic?</h1>

<form method="post">
    <div>Title:</div><input type="text" value="<?=
    htmlspecialchars($this->topic['topic_subject'])?>" disabled/>
    
    <div><input type="submit" value="Delete"/>
        <a href="<?=APP_ROOT?>/topics">[Cancel]</a></div>
</form>