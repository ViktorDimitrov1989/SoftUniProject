<?php
class TopicsController extends BaseController

{
    function onInit()
    {
        // TODO: Implement "on initialization" logic
        $this->authorize();

    }
    public function index()
    {
       // TODO: Implement "index" page logic
        $this->topic = $this->model->getAll();

    }
   /* public function tagsIterate(array $tags) TODO
    {
        foreach ($tags as $tag){

            $this->model->insertPostTags($this->model->getTagIdByName($tag),19);
        }
    }*/
    public function create()
    {
        if ($this->isPost){
//            This will check if the isPost field is set to true.
//            This field is only set to true if there is a “POST” request to the server,
//            and since our only “POST” in the Posts context is about creating posts,
//            it is perfect for this function.
                $subject = $_POST['topic_title'];
            if (strlen($subject) < 1){
                $this->setValidationError("topic_title", "Title cannot be empty!");
            }
            $tagName = $_POST['tag_name'];
            $categoryId = $_POST['category_id'];
            if ($this->formValid()){
                $userId =  $_SESSION['user_id'];
                
                if ($this->model->create($subject, $categoryId, $tagName)){
                    $this->addInfoMessage("Topic created");
                    $this->redirect("topics");
                }
                else{
                    $this->addErrorMessage("Error: cannot create topic");
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
    public function edit(int $id)
    {

        if ($this->isPost){
            //Edit requested post (update it's fields)
            $title = $_POST['topic_subject'];
            if (strlen($title) < 1){
                $this->setValidationError("topic_subject", "Topic title cannot be empty!");
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
                if ($this->model->edit($id, $title)){
                    $this->model->updateTag($this->model->getTagIdByName($_POST['tag_name']),$id);
                    $this->addInfoMessage("Topic edited.");
            }
                else{
                    $this->addErrorMessage("Error. Cannot edit this topic.");
                }
                $this->redirect('topics');
            }
                

//            Now, this will preload the post into the edit form,
//            enabling us to edit it, and only when we submit the new values,
//            the code in the if statement will execute.
//            This should finalize our work in the PostController class.
        }

        $topic = $this->model->getById($id);
        if (!$topic){
            $this->addErrorMessage("Error: post does not exist.");
            $this->redirect("posts", "view");
        }
        $this->topic = $topic;
    }
    public function delete(int $id)
    {
        if($this->isPost){
            //Delete the requested post by id
            if ($this->model->delete($id)){
                $this->addInfoMessage("Topic deleted.");
            }
            else{
                $this->addErrorMessage("Error: cannot delete topic.");
            }
            $this->redirect('topics');
        }
        else{
            //show confirm/delete form

            $topic = $this->model->getById($id);
            if (!$topic){
                $this->addErrorMessage("Topic does not exist.");
                $this->redirect("", "view");
            }
            $this->topic = $topic;
        }
    }
    public function view(){
        $this->topic = $this->model->getAll();
    }

}