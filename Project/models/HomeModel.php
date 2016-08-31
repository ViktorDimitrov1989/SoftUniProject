<?php

class HomeModel extends BaseModel
{
    // TODO: your database access functions for the home page will come here ...
    public function search(string $str) : array 
    {
        $statement = self::$db->query("SELECT * FROM topics WHERE topic_subject LIKE '%$str%'");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    public function getCategoryName(int $categoryId)
    {
        $statement = self::$db->query("SELECT category_name FROM categories WHERE category_id = $categoryId");
        $result = $statement->fetch_all(MYSQLI_ASSOC);
        return $result[0];
    }
    public function getLastPosts(int $maxCount = 5) : array
    {
        $statement = self::$db->query("SELECT posts.id, title, content, date, full_name " .
        "FROM posts LEFT JOIN users ON posts.user_id = users.id " .
        "ORDER BY date DESC LIMIT $maxCount");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getLastCategories(int $maxCount = 5) : array
    {
        $statement = self::$db->query("SELECT categories.category_id, category_name, category_description " .
            "FROM forum.categories");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getLastTopics(int $maxCount = 5) : array
    {
        $statement = self::$db->query("SELECT topics.id, topic_subject, topic_category " .
            "FROM forum.topics");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT posts.id, title, content, date, full_name " .
            "FROM posts LEFT JOIN users ON posts.user_id = users.id " .
            "WHERE posts.id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function getCategoryById(int $id)
    {
        $statement = self::$db->prepare(
            "SELECT categories.category_id, category_name, category_description " .
            "WHERE categories.category_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }
}
