<?php

namespace Controllers;

use Models\PostManager;
use Models\UserManager;

class BlogController extends BaseController
{

    public function index()
    {

        $postmanager = new PostManager;
        $posts = $postmanager->postsUser();
        $this->view->render('blog.home', compact('posts'));
        
    }
    
    public function show($id)
    {
        $postmanager = new PostManager;
        $post = $postmanager->find($id);
        $this->view->render('blog.single', compact('post'));
    }
    
    public function user($id)
    {
        $postmanager = new UserManager;
        $post = $postmanager->postsUserId($id);
        $this->view->render('blog.single', compact('post'));
    }

}
