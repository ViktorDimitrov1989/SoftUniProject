<?php $this->title = 'Results from search in topics:';?>



<h1><?=htmlspecialchars($this->title)?></h1>
<table>
    
    <tr>
        <th>Topic subject</th>
        <th>posted on:</th>
        <th>by</th>
        <th>in category:</th>
    </tr>
    //TODO:*in category:
    <?php foreach ($this->topics as $topic) : ?>
        <tr>
            <td><?= htmlspecialchars($topic['topic_subject'])?></td>
            <td><?= htmlspecialchars($topic['topic_date'])?></td>
            <td><?= htmlspecialchars($topic['topic_by'])?></td>
            <td><?= htmlspecialchars($this->model->getCategoryName(1)['category_name'])?></td>
            <!--<td><a href="<?/*=APP_ROOT*/?>/posts/edit/<?/*= $post['id']*/?>">[Edit]</a>
                <a href="<?/*=APP_ROOT*/?>/posts/delete/<?/*= $post['id']*/?>">[Delete]</a></td>-->
        </tr>
    <?php endforeach ?>


    <?php /*endforeach*/?>

</table>