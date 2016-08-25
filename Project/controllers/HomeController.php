<?php

class HomeController extends BaseController
{
    function index()
    {
        // TODO: Load posts to be displayed here ...
        $lastCategories = $this->model->getLastCategories(5);
        $lastTopics = $this->model->getLastTopics(5);
        $this->categories = array_slice($lastCategories, 0, 3);
        $this->sidebarTopics = $lastTopics;
        $this->topics = array_slice($lastTopics, 0, 3);
    }
	
	function view($id)
    {
        // TODO: Load a post to be displayed here ...
        $this->post = $this->model->getPostById($id);
        $this->topic = $this->model->getTopicById($id);
        $this->categories = $this->model->getCategoryById($id);
    }
}
