<?php $this->title = 'Topics';?>

<h1><?=htmlspecialchars($this->title)?></h1>

<table>

    <tr>
        <th>ID</th>
        <th>Subject</th>
        <th>Tags</th>

    </tr>
    <?php foreach ($this->topic as $topic) :?>
        <tr>
            <td><?= $topic['id']?></td>
            <td><?= htmlspecialchars($topic['topic_subject'])?></td>
            <td><?= htmlspecialchars($this->model->getTags($topic['id']))?></td>

            <td>

                <a href="<?=APP_ROOT?>/topics/edit/<?= $topic['id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/topics/delete/<?= $topic['id']?>">[Delete]</a></td>

        </tr>
    <?php endforeach?>
    <!--    This is how a foreach loop is made in PHP scripts. -->
    <!--    The loop will traverse all the posts from the controller, -->
    <!--    which we previously extracted, and will print info about each of those posts, -->
    <!--    on each table row, separating the values into the columns of that row. -->
    <!--    Also, this will add two links, which will later point to the edit and delete functionalities. -->
    <!--    We will implement them later.-->
</table>
<!--<a href="<?/*=APP_ROOT*/?>/topics/create">[Create new]</a>-->
