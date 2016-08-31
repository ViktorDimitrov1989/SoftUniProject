<?php
class PostsController extends BaseController

{
    function onInit()
    {
        // TODO: Implement "on initialization" logic
        $this->authorize();
    }
    public function index()
    {
       // TODO: Implement "index" page logic
        $this->posts = $this->model->getAll();
    }
   /* public function tagsIterate(array $tags) TODO
    {
        foreach ($tags as $tag){

            $this->model->insertPostTags($this->model->getTagIdByName($tag),19);
        }
    }*/
    public function create($topicId)
    {
        if ($this->isPost){
//            This will check if the isPost field is set to true.
//            This field is only set to true if there is a “POST” request to the server,
//            and since our only “POST” in the Posts context is about creating posts,
//            it is perfect for this function.
                $title = $_POST['post_title'];
            if (strlen($title) < 1){
                $this->setValidationError("post_title", "Title cannot be empty!");
            }
            $content = $_POST['post_content'];
            if (strlen($content) < 1){
                $this->setValidationError("post_content", "Content cannot be empty!");
            }

            
            if ($this->formValid()){
                $userId =  $_SESSION['user_id'];
                if ($this->model->create($title, $content, $userId, $topicId)){

                    $this->addInfoMessage("Post created");
                    $this->redirect("posts");

                }
                else{
                    $this->addErrorMessage("Error: cannot create post");
                    $this->redirect("");
                }
            }
        }
    }
/*    public function dropDownId()
    {
        $this->ids = $this->model->getAllId();
        //view the users id
    }*/
    public function edit($id)
    {
        if ($this->isPost){
            //Edit requested post (update it's fields)
            $title = $_POST['post_title'];
            if (strlen($title) < 1){
                $this->setValidationError("post_title", "Post title cannot be empty!");
            }
            $content = $_POST['post_content'];
            if (strlen($content) < 1){
                $this->setValidationError("post_content", "Content cannot be empty!");
            }
            $date = $_POST['post_date'];
            $dateRegex = '/^\d{2,4}-\d{1,2}-\d{1,2}( \d{1,2}:\d{1,2}(:\d{1,2})?)?$/';
            if (!preg_match($dateRegex, $date)){
                $this->setValidationError("post_date", "Invalid date");
            }
            $user_id = $_SESSION['user_id'];
            if ($user_id <= 0 || $user_id > 1000000){
                $this->setValidationError("user_id", "Invalid author user ID");
            }
           //            The same if which validates if the request method is “POST”,
//            and several form value, validations in it.
//            Notice how the date is validated using regular expressions (REGEX).
//            If all validations have succeeded we must edit the post, using the model,

            if ($this->formValid()){
                if ($this->model->edit($id, $title, $content, $date, $user_id)){

                    $this->addInfoMessage("Post edited.");
                    $this->redirect("posts", "view");
            }
                else{
                    $this->addErrorMessage("Error. Cannot edit this post.");
                }
                $this->redirect('posts', 'view');
            }

//            Now, this will preload the post into the edit form,
//            enabling us to edit it, and only when we submit the new values,
//            the code in the if statement will execute.
//            This should finalize our work in the PostController class.
        }
        
        $post = $this->model->getById($id);
        if (!$post){
            $this->addErrorMessage("Error: post does not exist.");
            $this->redirect("posts", "view");
        }
        $this->post = $post;
    }
    public function delete($id)
    {
        if($this->isPost){
            //Delete the requested post by id
            if ($this->model->delete($id)){
                $this->addInfoMessage("Post deleted.");
            }
            else{
                $this->addErrorMessage("Error: cannot delete post.");
            }
            $this->redirect('posts', 'view');
        }
        else{
            //show confirm/delete form

            $post = $this->model->getById($id);
            if (!$post){
                $this->addErrorMessage("Post does not exist.");
                $this->redirect("posts", "view");
            }
            $this->post = $post;
        }
    }
    public function view(){
        $this->posts = $this->model->viewUserPosts();
    }
    

}