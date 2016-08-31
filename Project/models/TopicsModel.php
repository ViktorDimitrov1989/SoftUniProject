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
        $statement = self::$db->prepare("SELECT * FROM forum.topics WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }
    public function tags() : array
    {
        $statement = self::$db->query("SELECT * FROM tags;");
        return $statement->fetch_all(MYSQLI_ASSOC);

    }

    public function categories() : array
    {
        $statement = self::$db->query("SELECT * FROM categories;");
        return $statement->fetch_all(MYSQLI_ASSOC);

    }
    public function getTagIdByName(string $tagName) : int
    {
        $statement = self::$db->prepare("SELECT tags.id FROM tags WHERE tags.name = ? ");
        $statement->bind_param("s", $tagName);
        $statement->execute() or die($statement->error);
        $result = $statement->get_result();
        if (!$result->num_rows){
            return null;
        }
        else{
            return $result->fetch_assoc()['id'];
        }

    }
    public function insertTopicTags($topicId, $tagId)
    {
        $statementTag = self::$db->prepare("INSERT INTO topic_tags(topic_id, tag_id) VALUES(?,?) ");
        $statementTag->bind_param("ii", $topicId, $tagId);
        $statementTag->execute();

    }
    public function create(string $title, int $id, int $tagName, int $categoryId) : bool
    {
        //TODO: CREATE TOPIC AND PUT IT INTO DATABASE
        $statement = self::$db->prepare(
            "INSERT INTO forum.topics(topic_subject, topic_by, topic_category) VALUES(?,?,?) ");
        $statement->bind_param("sii", $title, $id, $categoryId);
        $statement->execute();

        $id = $statement->insert_id;
        $this->insertTopicTags($id,$this->getTagIdByName($tagName));


        return $statement->affected_rows == 1;

//        This will create a query, which will insert a post into the posts table.
//    The query will be applied the, given by the controller, parameters and will be executed,
//        returning a Boolean result, indicating whether it succeeded or failed.
    }

    public function edit(
        int $id, string $title) : bool
    {

        //TODO: EDIT TOPIC BY A GIVEN ID
        $statement = self::$db->prepare("UPDATE topics SET topic_subject = ? WHERE id = ?");
        $statement->bind_param("si", $title, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }

    public function delete(int $id) : bool
    {
        //TODO: DELETE TOPIC BY A GIVEN ID

        $statement = self::$db->prepare("DELETE FROM forum.topics WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }
    public function view(int $topicId): array
    {
        $userID = $_SESSION['user_id'];
        $statement = self::$db->prepare("SELECT * FROM forum.posts jOIN forum.topics WHERE topics.id = ?");
        $statement->bind_param("i", $topicId);
        $statement->execute();
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
    public function updateTag($tagId, $topicId)
    {
        $statement = self::$db->prepare("UPDATE forum.topic_tags SET tag_id = ?  WHERE topic_id = ?");
        $statement->bind_param("ii", $tagId, $topicId);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }
    public function getTags($topicId)
    {
        $statement = self::$db->prepare("SELECT tags.name FROM forum.tags LEFT JOIN " . 
		"forum.topic_tags " . 
			"ON forum.tags.id = topic_tags.tag_id " .
		"LEFT JOIN forum.topics " .
			"ON forum.topics.id = topic_tags.topic_id " .
            "WHERE topics.id = ? ");
        $statement->bind_param("i",$topicId);
        $statement->execute() or die($statement->error);
        $result = $statement->get_result();
        if (!$result->num_rows){
            return null;
        }
        else{
            return $result->fetch_assoc()['name'];
        }
    }

    public function getAllPosts() : array
    {
        //TODO: GET POSTS FROM THE DATABASE
        $statement = self::$db->query("SELECT * FROM forum.posts ORDER BY DATE DESC");
        return $statement->fetch_all(MYSQLI_ASSOC);
//        The function returns an array, as specified in the function declaration.
//        This array consists of all the posts, fetched from the Database using a query,
//        and ordered in descending order by the date they were posted on.

    }
}
?>