<?php

class TagsController extends BaseController
{
    public function index()
    {
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
}