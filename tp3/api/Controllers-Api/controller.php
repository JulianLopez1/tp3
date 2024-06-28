<?php

require_once 'api/viewApi/ApiView.php';
require_once 'api/helpers/loginHelpers.php';

class Controller {
    protected $user;
    protected $view;   
    private $data;

    public function __construct() {
        $this->user = new loginHelpers();     
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    function getData() {
        return json_decode($this->data);
    }
}