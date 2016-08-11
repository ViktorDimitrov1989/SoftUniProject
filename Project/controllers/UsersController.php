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
            if ($this->formValid()){
                $userId = $this->model->register($username, $password, $full_name, $email);

                if ($userId){
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $userId;
                    $this->addInfoMessage("Registration successful.");
                    $this->redirect("posts");
                }
                else{
                    $this->addErrorMessage("Error: user registration failed!");
                }
            }
        }

    }

    public function login()
    {
		// TODO: your user login functionality will come here ...
        if ($this->isPost){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $loggedUserId = $this->model->login($username, $password);
            if ($loggedUserId){
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $loggedUserId;
                $this->addInfoMessage("Login succesfull.");
                return $this->redirect("home");
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
