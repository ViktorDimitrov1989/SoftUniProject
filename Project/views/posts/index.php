<?php $this->title = 'Posts';?>

<h1><?=htmlspecialchars($this->title)?></h1>

<table>

    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Date</th>
        <th>Author</th>
        <th>Action</th>
    </tr>
        <?php foreach ($this->posts as $post) :?>
            <?/*= var_dump($post)*/?>
        <tr>
            <td><?= $post['id']?></td>
            <td><?= htmlspecialchars($post['title'])?>></td>
            <td><?= cutLongText($post['content'])?></td>
            <td><?= htmlspecialchars($post['date'])?></td>
            <td><?= $post['user_id']?></td>

            <td>
            <?php if ($post['user_id'] == $_SESSION['user_id']) : ?>
                <a href="<?=APP_ROOT?>/posts/edit/<?= $post['id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/posts/delete/<?= $post['id']?>">[Delete]</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach?>
<!--    This is how a foreach loop is made in PHP scripts. -->
<!--    The loop will traverse all the posts from the controller, -->
<!--    which we previously extracted, and will print info about each of those posts, -->
<!--    on each table row, separating the values into the columns of that row. -->
<!--    Also, this will add two links, which will later point to the edit and delete functionalities. -->
<!--    We will implement them later.-->
</table>
<a href="<?=APP_ROOT?>/posts/create">[Create new]</a>
