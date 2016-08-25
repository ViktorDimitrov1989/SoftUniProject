<?php

/**
 * Created by PhpStorm.
 * User: Виктор
 * Date: 10.7.2016 г.
 * Time: 22:48 ч.
 */
class CategoriesModel extends BaseModel
{
    public function getAll() : array
    {
        //TODO: GET POSTS FROM THE DATABASE
        $statement = self::$db->query("SELECT * FROM blog.categories ORDER BY DATE DESC");
        return $statement->fetch_all(MYSQLI_ASSOC);
//        The function returns an array, as specified in the function declaration.
//        This array consists of all the posts, fetched from the Database using a query,
//        and ordered in descending order by the date they were posted on.

    }
    public function getById(int $id)
    {
        //TODO: GET PARTICULAR POST FROM DATABASE BY ID
        $statement = self::$db->prepare("SELECT category_id, category_name, category_description, FROM categories WHERE category_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function create(string $title, string $content, string $user_id) : bool
    {
        //TODO: CREATE POST AND PUT IT INTO DATABASE
        $statement = self::$db->prepare(
            "INSERT INTO blog.categories(category_name, category_description) VALUES(?,?,?)" );
        $statement->bind_param("ss", $title, $content);
        $statement->execute();
        return $statement->affected_rows == 1;
//        This will create a query, which will insert a post into the posts table.
//    The query will be applied the, given by the controller, parameters and will be executed,
//        returning a Boolean result, indicating whether it succeeded or failed.
    }
    public function edit(
        string $id, string $title, string $content) : bool
    {
        //TODO: EDIT POST BY A GIVEN ID
        $userID = $_SESSION['user_id'];
        $statement = self::$db->prepare("UPDATE categories SET category_name = ?, category_description = ? WHERE category_id = ?");
        $statement->bind_param("ssi", $title, $content, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }
    public function delete(int $id) : bool
    {
        //TODO: DELETE POST BY A GIVEN ID
        $statement = self::$db->prepare("DELETE FROM categories WHERE category_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }


}