<?php

class UsersController extends BaseController
{
    public function index()
    {
        $this->authorize();
        $this->users = $this->model->getAll();
        //view the users


    }

    public function register()
    {
        // TODO: your user registration functionality will come here ...
        if ($this->isPost){
            $username = $_POST['username'];
            if (strlen($username) <= 2){
                $this->setValidationError("username", "Username must be bigger than 2 characters!");
            }
            if (strlen($username) >= 50){
                $this->setValidationError("username", "Username must contain less than 50 characters!");
            }
            $password = $_POST['password'];
            if (strlen($password) <= 2){
                $this->setValidationError("password", "Password must be bigger than 2 characters!");
            }
            if (strlen($username) >= 50){
                $this->setValidationError("password", "Password must contain less than 50 characters!");
            }
            $confirm_password = $_POST['confirm_password'];
            if ($password != $confirm_password){
                $this->setValidationError("confirm_password", "Passwords do not match!");
            }
            $full_name = $_POST['full_name'];
            if (strlen($full_name) > 200){
                $this->setValidationError("full_name", "Invalid full name!");
            }
            $email = $_POST['email'];
            $status = 1;
            if ($this->formValid()){
                $userId = $this->model->register($username, $password, $full_name, $email, $status);

                if ($userId){
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $userId;
                    $roleId = 3;
                    $role = $this->model->setRole($userId, $roleId);
                    $_SESSION['role'] = $role;
                    $this->addInfoMessage("Registration successful.");
                    $this->redirect("posts");
                }
                else{
                    $this->addErrorMessage("Error: user registration failed!");
                }
            }
        }

    }
    public function edit_your_profile()
    {
        //LOGGED USER EDIT HE's OWN PROFILE
        $id = $_SESSION['user_id'];
        if ($this->isPost){
            //Edit requested post (update it's fields)


            $fullName = $_POST['full_name'];

            $email = $_POST['email'];

            $passwordHash = $this->model->getPass($id)['password_hash'];
            $oldPassword = $_POST['old_pass'];
            if (password_verify($oldPassword, $passwordHash)) {

            }
            else {
                $this->setValidationError('old_pass', 'Inserted old password do not match');
            }
            $newPass = $_POST['nPass'];
            $repNewPass = $_POST['repPass'];

            if ($newPass == $repNewPass){
                $password_hash = $newPass;
                if ($this->formValid()){
                    if ($this->model->editProfile($id, $fullName, $email, $password_hash)){
                        $this->addInfoMessage("Profile edited.");
                    }
                    else{
                        $this->addErrorMessage("Error. Cannot edit your profile.");
                    }
                    $this->redirect('');
                }
            }
            else{
                $this->setValidationError('repPass', 'New password fields do not match');
            }



        }

        $user = $this->model->getById($id);
        if (!$user){
            $this->addErrorMessage("Error: user does not exist.");
            $this->redirect("users", "index");
        }
        $this->post = $user;
    }
    public function block($userId)
    {
        if($this->isPost){
            //Block the requested user by id
            if ($this->model->changeStatus(2, $userId)){
                $this->addInfoMessage("User blocked.");
            }
            else{
                $this->addErrorMessage("Error: cannot block this user.");
            }
            $this->redirect('users');
        }
        else{


            $user = $this->model->getById($userId);
            if (!$user){
                $this->addErrorMessage("User does not exist.");
                $this->redirect("users");
            }
            $this->post = $user;
        }
    }
    public function unblock($userId)
    {
        //Unblock the requested user by id
        if ($this->model->changeStatus(1, $userId)){
            $this->addInfoMessage("User unblocked.");
        }
        else{
            $this->addErrorMessage("Error: cannot unblock this user.");
        }
        $this->redirect('users');
    }
    public function edit(int $id)
    {

        if ($this->isPost){
            //Edit requested user (update it's fields)


            $fullName = $_POST['full_name'];

            $email = $_POST['email'];

            $status = $_SESSION['status'];


            $role = $_POST['roles'];
            //            The same if which validates if the request method is “POST”,
//            and several form value, validations in it.
//            Notice how the date is validated using regular expressions (REGEX).
//            If all validations have succeeded we must edit the post, using the model,

            if ($this->formValid()){
                if ($this->model->edit($id, $fullName, $email)){
                    $this->model->setRole($role, $id);
                    $this->addInfoMessage("User edited.");
                }
                else{
                    $this->addErrorMessage("Error. Cannot edit this user.");
                }
                $this->redirect('users', 'index');
            }


//            Now, this will preload the post into the edit form,
//            enabling us to edit it, and only when we submit the new values,
//            the code in the if statement will execute.
//            This should finalize our work in the PostController class.
        }

        $user = $this->model->getById($id);
        if (!$user){
            $this->addErrorMessage("Error: user does not exist.");
            $this->redirect("users", "index");
        }
        $this->post = $user;
    }



    public function login()
    {
        // TODO: your user login functionality will come here ...
        if ($this->isPost){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $status = $this->model->status($username);
            $_SESSION['status'] = $status;
            if ($status == 2){
                $this->addErrorMessage("You are banned from this site!");
                return $this->redirect("home");
            }

            if (password_verify($password, $this->model->getPassByUsername($username)['password_hash'])){
                $loggedUserId = $this->model->login($username, $password);



                if ($loggedUserId){
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $loggedUserId;



                    if ($this->model->role($loggedUserId) != null){
                        $role = $this->model->role($loggedUserId);
                        $this->addErrorMessage("Hello $role");
                        $_SESSION['role'] = $role;
                    }
                    else{
                        $this->addErrorMessage("Hello user");
                        /*unset($_SESSION['role']);*/
                    }
                    $this->addInfoMessage("Login succesfull.");

                    return $this->redirect("home");
                }
                if ($this->model->getRank($loggedUserId) > 0 && $this->model->getRank($loggedUserId) < 11){
                    $this->addInfoMessage("Your rank is nubie");
                }
            }
            else{
                $this->addErrorMessage("Login failed!");
            }
        }
    }

    public function logout()
    {
        // TODO: your user logout functionality will come here ...
        session_destroy();
        $this->addInfoMessage("Logout successful");
        $this->redirect("");
    }
}
