<?php $this->title = 'Welcome to My Forum';

?>

<h1><?=htmlspecialchars($this->title)?></h1>

<!-- TODO: display the posts here -->

<aside>
    <h2>Recent Topics</h2>
    <?php foreach ($this->sidebarTopics as $topic) : ?>
        <a href="<?=APP_ROOT?>/topics/view/<?=$topic['id']?>"><?= htmlentities($topic['topic_subject'])?></a>
    <?php endforeach ?>
</aside>
<form class="search" action="home/search" method="post">
    <input type="text" name="search"/>
    <input type="submit" name="submit" value="search">
</form>
<main id="categories">
    <div class="list-categories">
        <?php foreach ($this->categories as $category) : ?>
            <div class="category-name">
                <a href="<?=APP_ROOT?>/topics/create/<?=$category['category_id']?>"><?=htmlentities($category['category_name'])?></a>
                <i>create topic in this category by this hyperlink</i>
            </div>
            <p class="content"><?=$category['category_description']?></p>
            <div class="category-content">
                <?php foreach ($this -> topics as $topic) : ?>
                    <?php if ($category['category_id'] == $topic['topic_category'])
                    {?>
                        <a href="<?=APP_ROOT?>/topics/view/<?=$topic['id']?>" class="topic_subject"><?=htmlentities($topic['topic_subject'])?></a><?php

                    }?>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    </div>
</main>

<a href="<?=APP_ROOT?>/categories/view/">List Categories</a>

