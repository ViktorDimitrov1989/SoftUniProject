<?php


class PostsModel extends BaseModel
{

    public function getAll() : array
    {
        //TODO: GET POSTS FROM THE DATABASE
        $statement = self::$db->query("SELECT * FROM forum.posts ORDER BY DATE DESC");
        return $statement->fetch_all(MYSQLI_ASSOC);
//        The function returns an array, as specified in the function declaration.
//        This array consists of all the posts, fetched from the Database using a query,
//        and ordered in descending order by the date they were posted on.

    }
    public function getById($id)
    {
        //TODO: GET PARTICULAR POST FROM DATABASE BY ID
        
        $statement = self::$db->prepare("SELECT id, title, content, date, user_id, tagName
        FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }
    public function getAllId() : array
    {
        $statement = self::$db->query("SELECT id FROM users ORDER BY id ASC");
        return $statement->fetch_all(MYSQLI_ASSOC);
        //The function fetches all id's of the users from DB
    }
    /*public function setTag(int $postId, int $tagId)
    {
        $statement = self::$db->prepare("INSERT INTO post_tags(post_id, tag_id) VALUES(?,?) ");
            $statement->bind_param("ii", $postId, $tagId);
            $result = $statement->execute();
            return $result;
        
    }*/

    public function create(string $title, string $content, string $user_id, int $topic_id) : bool
    {
        //TODO: CREATE POST AND PUT IT INTO DATABSE
        $statement = self::$db->prepare(
            "INSERT INTO forum.posts(title, content, user_id, topic_id) VALUES(?,?,?,?)");
        $statement->bind_param("sssi", $title, $content, $user_id, $topic_id);
        $statement->execute();
        

        return $statement->affected_rows == 1;

//        This will create a query, which will insert a post into the posts table.
//    The query will be applied the, given by the controller, parameters and will be executed,
//        returning a Boolean result, indicating whether it succeeded or failed.
    }
    public function edit(
        string $id, string $title, string $content, string $date, int $user_id) : bool
    {

        //TODO: EDIT POST BY A GIVEN ID
        
        $statement = self::$db->prepare("UPDATE posts SET title = ?, content = ?, date = ?, " .
        "user_id = ? WHERE id = ?");
        $statement->bind_param("sssii", $title, $content, $date, $user_id, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }
    public function delete(int $id) : bool
    {
        //TODO: DELETE POST BY A GIVEN ID
        
        $statement = self::$db->prepare("DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
    public function viewUserPosts(): array
    {
        $userID = $_SESSION['user_id'];
        $statement = self::$db->query("SELECT * FROM forum.posts WHERE posts.user_id = $userID");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    public function equal(int $id)
    {
        $statement = self::$db->query("SELECT posts.id FROM posts WHERE id = $id");
        $statement->bind_param("i", $id);

        return $statement->result();
    }



}