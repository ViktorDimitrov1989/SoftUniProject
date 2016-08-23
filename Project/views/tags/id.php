<form method="post">
<div>Id:</div>
<input type="text" name="tag_name" />
<div><input type="submit" value="Check" /></div>
<?=var_dump($this->model->getTagIdByName($_POST['tag_name']))?>

</form>
