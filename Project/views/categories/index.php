<?php $this->title = 'Categories';?>

<h1><?=htmlspecialchars($this->title)?></h1>

<table>

    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Action</th>
    </tr>
    <?php foreach ($this->categories as $category) :?>
        <tr>
            <td><?= $category['category_id']?></td>
            <td><?= htmlspecialchars($category['category_name'])?></td>
            <td><?= cutLongText($category['category_description'])?></td>

            <td>

                <a href="<?=APP_ROOT?>/categories/edit/<?= $category['category_id']?>">[Edit]</a>
                <a href="<?=APP_ROOT?>/categories/delete/<?= $category['category_id']?>">[Delete]</a></td>

        </tr>
    <?php endforeach?>
    <!--    This is how a foreach loop is made in PHP scripts. -->
    <!--    The loop will traverse all the posts from the controller, -->
    <!--    which we previously extracted, and will print info about each of those posts, -->
    <!--    on each table row, separating the values into the columns of that row. -->
    <!--    Also, this will add two links, which will later point to the edit and delete functionalities. -->
    <!--    We will implement them later.-->
</table>
<a href="<?=APP_ROOT?>/categories/create">[Create new]</a>
