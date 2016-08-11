<?php

class UsersModel extends BaseModel
{
    // TODO: your database access functions for the user register / login will come here ...
    public function getAll() : array
    {
        $statement = self::$db->query("SELECT * FROM users ORDER BY username");
        return $statement->fetch_all(MYSQLI_ASSOC);
//        The function fetches all the users from the Database
//        and orders them in alphabetical order.

    }
    
    public function register(
        $username, $password, $full_name, $email)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $statement = self::$db->prepare(
            "INSERT INTO users (username, password_hash, full_name, email) VALUES (?, ?, ?, ?)");
        $statement->bind_param("ssss", $username, $password_hash, $full_name, $email);
        $statement->execute();
        if ($statement->affected_rows !=1)
            return false;
        $user_id = self::$db->query("SELECT LAST_INSERT_ID()")->fetch_row()[0];
        return $user_id;
    }
    public function login(string $username, string $password)
    {
        $statement = self::$db->prepare("SELECT id FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if (password_verify($password, $result['password_hash']));
            return $result['id'];
        return false;
    }
    

}
