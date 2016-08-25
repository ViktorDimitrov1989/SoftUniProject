<?php


class TopicsModel extends BaseModel
{

    public function getAll() : array
    {
        //TODO: GET POSTS FROM THE DATABASE
        $statement = self::$db->query("SELECT * FROM forum.topics ");
        return $statement->fetch_all(MYSQLI_ASSOC);
//        The function returns an array, as specified in the function declaration.
//        This array consists of all the posts, fetched from the Database using a query,
//        and ordered in descending order by the date they were posted on.

    }

    public function getById(int $id)
    {
        //TODO: GET PARTICULAR POST FROM DATABASE BY ID
        $statement = self::$db->prepare("SELECT topic_subject FROM forum.topics WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function create(string $title) : bool
    {
        //TODO: CREATE POST AND PUT IT INTO DATABSE
        $statement = self::$db->prepare(
            "INSERT INTO forum.topics(topic_subject) VALUES(?) ");
        $statement->bind_param("s", $title);
        $statement->execute();


        return $statement->affected_rows == 1;

//        This will create a query, which will insert a post into the posts table.
//    The query will be applied the, given by the controller, parameters and will be executed,
//        returning a Boolean result, indicating whether it succeeded or failed.
    }

    public function edit(
        string $id, string $title) : bool
    {

        //TODO: EDIT POST BY A GIVEN ID
        $statement = self::$db->prepare("UPDATE topics SET topic_subject = ?, WHERE id = ?");
        $statement->bind_param("si", $title, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }

    public function delete(int $id) : bool
    {
        //TODO: DELETE POST BY A GIVEN ID

        $statement = self::$db->prepare("DELETE FROM topics WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
    public function view(): array
    {
        $userID = $_SESSION['user_id'];
        $statement = self::$db->query("SELECT * FROM forum.topics JOIN forum.categories WHERE topic_category = categories.category_id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}
?>