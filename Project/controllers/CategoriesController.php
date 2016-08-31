<?php
class CategoriesController extends BaseController

{
    function onInit()
    {
        // TODO: Implement "on initialization" logic
        $this->authorize();

    }
    public function index()
    {
        // TODO: Implement "index" page logic
        $this->categories = $this->model->getAll();

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
            $title = $_POST['category_name'];
            if (strlen($title) < 1){
                $this->setValidationError("category_name", "Title cannot be empty!");
            }
            $content = $_POST['category_description'];
            if (strlen($content) < 1){
                $this->setValidationError("category_description", "Content cannot be empty!");
            }

            if ($this->formValid()){

                if ($this->model->create($title, $content)){

                    $this->addInfoMessage("Category created");
                    $this->redirect("");

                }
                else{
                    $this->addErrorMessage("Error: cannot create category");
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
    public function edit($i)
    {
        $id = base64_decode($i);
        if ($this->isPost){
            //Edit requested post (update it's fields)
            $title = $_POST['category_name'];
            if (strlen($title) < 1){
                $this->setValidationError("category_name", "Category title cannot be empty!");
            }
            $content = $_POST['category_description'];
            if (strlen($content) < 1){
                $this->setValidationError("category_description", "Content cannot be empty!");
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
                if ($this->model->edit($id, $title, $content)){

                    $this->addInfoMessage("Category edited.");
                }
                else{
                    $this->addErrorMessage("Error. Cannot edit this category.");
                }
                $this->redirect('categories');
            }

//            Now, this will preload the post into the edit form,
//            enabling us to edit it, and only when we submit the new values,
//            the code in the if statement will execute.
//            This should finalize our work in the PeostController class.
        }
        $category = $this->model->getCategoryById($id);
        if (!$category){
            $this->addErrorMessage("Error: category does not exist.");
            $this->redirect("", "view");
        }
        $this->category = $category;


    }
    public function delete($i)
    {
        $id = base64_decode($i);
        if($this->isPost){
            //Delete the requested post by id
            if ($this->model->delete($id)){
                $this->addInfoMessage("Category deleted.");
            }
            else{
                $this->addErrorMessage("Error: cannot delete category.");
            }
            $this->redirect('categories');
        }
        else{
            //show confirm/delete form

            $category = $this->model->getCategoryById($id);
            if (!$category){
                $this->addErrorMessage("Category does not exist.");
                $this->redirect("", "view");
            }
            $this->categories = $category;
        }

    }
    public function view(){
        $this->categories = $this->model->viewCategories();
    }


}