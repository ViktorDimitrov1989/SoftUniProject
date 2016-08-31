<?php

class HomeController extends BaseController
{
    function index()
    {
        // TODO: Load posts to be displayed here ...
        $lastCategories = $this->model->getLastCategories(5);
        $lastTopics = $this->model->getLastTopics(5);
        $this->categories = $lastCategories;
        $this->sidebarTopics = array_slice($lastTopics, 0, 5);
        $this->topics = $lastTopics;


    }
	function search()
    {
        $output = null;
        if (isset($_POST['submit'])){
            $search = htmlspecialchars($_POST['search']);

            $result = $this->model->search($search);
            if (count($result) > 0){
                $this->topics = $result;
            }
            else{
                $this->addInfoMessage("We didn't find any results for '$search', try something different");
                $this->redirect("");
            }
        }
    }
	function view($id)
    {
        // TODO: Load a post to be displayed here ...
        $this->post = $this->model->getPostById($id);
        $this->topic = $this->model->getTopicById($id);
        $this->categories = $this->model->getCategoryById($id);
    }

}
