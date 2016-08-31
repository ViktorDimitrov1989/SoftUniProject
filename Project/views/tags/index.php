<?php $this->title = 'Tags';?>

<h1><?=htmlspecialchars($this->title)?></h1>

<table>

    <tr>
        <th>ID</th>
        <th>Name</th>
        
    </tr>
    <?php foreach ($this->tags as $tag) :?>
        <tr>
            <td><?= $tag['id']?></td>
            <td><?= htmlspecialchars($tag['name'])?></td>
            <td>
                <a href="<?=APP_ROOT?>/tags/edit/<?= $tag['id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/tags/delete/<?= $tag['id']?>">[Delete]</a></td>
        </tr>
    <?php endforeach?>
    <!--    This is how a foreach loop is made in PHP scripts. -->
    <!--    The loop will traverse all the posts from the controller, -->
    <!--    which we previously extracted, and will print info about each of those posts, -->
    <!--    on each table row, separating the values into the columns of that row. -->
    <!--    Also, this will add two links, which will later point to the edit and delete functionalities. -->
    <!--    We will implement them later.-->
</table>
<a href="<?=APP_ROOT?>/tags/create">[Create new]</a>
