<?php

class TagsModel extends BaseModel
{
    public function getAll() : array
    {
        //TODO: GET tags FROM THE DATABASE
        $statement = self::$db->query("SELECT * FROM forum.tags");
        return $statement->fetch_all(MYSQLI_ASSOC);
//        The function returns an array, as specified in the function declaration.
//        This array consists of all the posts, fetched from the Database using a query,
//        and ordered in descending order by the date they were posted on.

    }
    public function getTagIdByName(string $tagName)
    {
        $statement = self::$db->prepare("SELECT id FROM tags WHERE tags.name = ? ");
        $statement->bind_param("s", $tagName);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }
    /*public function createTag(string $tagName)
    {
        $statement = self::$db->prepare(
            "INSERT INTO forum.tags(name);
        $statement->bind_param("s", $tagName);
        $statement->execute();


        return $statement->affected_rows == 1;
    }*/
    
}