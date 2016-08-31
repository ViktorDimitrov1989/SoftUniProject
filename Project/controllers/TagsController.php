<?php

class TagsController extends BaseController
{
    public function index()
    {
        if ($_SESSION['role'] != "Administrator"){
            $this->addErrorMessage("Only Administrator can see tags!");
            $this->redirect("");
        }
        $this->tags = $this->model->getAll();
    }
    public function id()
    {

        if ($this->isPost){
            $name = $_POST['tag_name'];

            $this->model->getTagIdByName($name);
            $this->addInfoMessage("PASS");

        }
    }
    public function create()
    {
        if ($_SESSION['role'] != "Administrator"){
            $this->addErrorMessage('Only Administrator can make tags!');
        }
        if ($this->isPost){
//            This will check if the isPost field is set to true.
//            This field is only set to true if there is a “POST” request to the server,
//            and since our only “POST” in the Posts context is about creating posts,
//            it is perfect for this function.
            
            if ($this->formValid()){
                $tagName = $_POST['tag_name'];
                if ($this->model->createTag($tagName)){

                    $this->addInfoMessage("Tag created");
                    $this->redirect("tags");

                }
                else{
                    $this->addErrorMessage("Error: cannot create tag");
                    $this->redirect("tags", "create");
                }
            }
        }
    }
    public function edit($id)
    {
        if ($this->isPost){

            if ($this->formValid()){
                $tagName = $_POST['tag_name'];
                if ($this->model->edit($tagName,$id)){

                    $this->addInfoMessage("Tag edited.");
                    $this->redirect("tags");
                }
                else{
                    $this->addErrorMessage("Error. Cannot edit this tag.");
                }
                $this->redirect('tags');
            }


//            Now, this will preload the post into the edit form,
//            enabling us to edit it, and only when we submit the new values,
//            the code in the if statement will execute.
//            This should finalize our work in the PostController class.
        }

        $tag = $this->model->getById($id);
        if (!$tag){
            $this->addErrorMessage("Error: post does not exist.");
            $this->redirect("posts", "view");
        }
        $this->tag = $tag;
    }
    public function delete($id)
    {

        if($this->isPost){
            //Delete the requested post by id
            if ($this->model->delete($id)){
                $this->addInfoMessage("Tag deleted.");
            }
            else{
                $this->addErrorMessage("Error: cannot delete tag.");
            }
            $this->redirect('tags');
        }
        else{
            //show confirm/delete form

            $tag = $this->model->getById($id);
            if (!$tag){
                $this->addErrorMessage("Post does not exist.");
                $this->redirect("posts", "view");
            }
            $this->tag = $tag;
        }


    }
}