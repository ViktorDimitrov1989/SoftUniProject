<?php $this->title = $this->topic['topic_subject'];?>

<h1><?=htmlspecialchars($this->title)?></h1>

<table>

    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Date</th>
        <th>Author</th>


    </tr>
    
    <?php foreach ($this->post as $post) :?>
        <?php if ($post['topic_id'] == $this->topic['id'])
        {?>
            <tr>
                <td><?= $post['id'] ?></td>
                <td><?= htmlspecialchars($post['title'])?></td>
                <td><?= $post['content']?></td>
                <td><?= $post['date']?></td>
                <td><?= $post['user_id']?></td>

                <td><a href="<?=APP_ROOT?>/posts/edit/<?= $post['id']?>">[Edit]</a>
                    <a href="<?=APP_ROOT?>/posts/delete/<?= $post['id']?>">[Delete]</a></td>
            </tr><?php
        }?>
    <?php endforeach ?>



    <!--    This is how a foreach loop is made in PHP scripts. -->
    <!--    The loop will traverse all the posts from the controller, -->
    <!--    which we previously extracted, and will print info about each of those posts, -->
    <!--    on each table row, separating the values into the columns of that row. -->
    <!--    Also, this will add two links, which will later point to the edit and delete functionalities. -->
    <!--    We will implement them later.-->
</table>

<a href="<?=APP_ROOT?>/posts/create/<?=$this->topic['id']?>">Create new Post For this topic</a>
