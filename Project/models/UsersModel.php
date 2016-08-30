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
        $username, $password, $full_name, $email, $status)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $status = 1;
        $statement = self::$db->prepare(
            "INSERT INTO users (username, password_hash, full_name, email, status) VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param("ssssi", $username, $password_hash, $full_name, $email, $status);
        $statement->execute();
        if ($statement->affected_rows !=1){
            return false;
        }
        
        $user_id = self::$db->query("SELECT LAST_INSERT_ID()")->fetch_row()[0];
        return $user_id;
    }
    public function status(string $username)
    {
        $statement = self::$db->prepare("SELECT status FROM forum.users WHERE users.username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        $data = $result->fetch_row();
        return $data[0];
    }
    public  function changeStatus(int $status, int $userId)
    {
        $statement = self::$db->prepare("UPDATE users SET status = ? WHERE users.id = ?");
        $statement->bind_param("ii", $status, $userId);
        $statement->execute();
        return $statement->affected_rows >= 0;
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
    public function role(int $id) : string
    {
        //GET THE ROLE OF THE LOGED USER
        $statement = self::$db->prepare("SELECT roles.role_name FROM roles LEFT JOIN user_role " .
		                                    "ON roles.id = user_role.role_id WHERE user_role.user_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $data = $result->fetch_row();
        
        return $data[0]?$data[0]:'user';
    }
    public function edit(
        int $id, string $full_name, string $email) : bool
    {
        //TODO: EDIT POST BY A GIVEN ID
        $statement = self::$db->prepare("UPDATE users SET full_name = ?, " .
            "email = ? WHERE id = ?");
        $statement->bind_param("ssi", $full_name, $email, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }
    public function editProfile(int $id,
         string $full_name, string $email, string $password) : bool
    {
        //TODO: EDIT profile of logged user
        $password_hash  = password_hash($password, PASSWORD_DEFAULT);
        $statement = self::$db->prepare("UPDATE users SET full_name = ?, email = ?, " .
            "password_hash = ? WHERE id = ?");
        $statement->bind_param("sssi", $full_name, $email, $password_hash, $id);
        $statement->execute();
        return $statement->affected_rows >= 0;
    }
    public function getById(int $id)
    {
        //TODO: GET PARTICULAR USER FROM DATABASE BY ID
        $statement = self::$db->prepare("SELECT username, full_name, email, password_hash
        FROM users WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }
    public function getAllRoles() : array
    {
        $statement = self::$db->query("SELECT * FROM roles");
        return $statement->fetch_all(MYSQLI_ASSOC);
//        The function fetches all the roles from the Database
    }
    public function setRole(int $role_id, int $user_id)
    {
        $statement = self::$db->prepare("INSERT INTO user_role (user_id, role_id) VALUES (?, ?)");
        $statement->bind_param("ii", $user_id, $role_id);
        $statement->execute();
        if ($statement->affected_rows != 1){
            return false;
        }
        return true;
    }
    public function getPass(int $id)
    {
        $statement = self::$db->prepare("SELECT password_hash FROM users WHERE users.id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }
    public function getPassByUsername(string $username)
    {
        //LOGIN
        $statement = self::$db->prepare("SELECT password_hash FROM users WHERE users.username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function getRank(int $id)
    {
        $statement = self::$db->prepare("SELECT COUNT(user_id) AS PostsFromUser FROM posts WHERE user_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement;
    }
}
