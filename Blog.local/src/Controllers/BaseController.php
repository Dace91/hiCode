<?php

namespace Controllers;

use Services\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->view->setLayout('layout.master');
    }
}
