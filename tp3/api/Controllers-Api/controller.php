<?php
require_once 'api/viewApi/apiView.php';
class Controller {

    protected $view;   
    private $data;

    public function __construct() {
        $this->view = new apiView();
        $this->data = file_get_contents("php://input");
    }

    function getData() {
        return json_decode($this->data);
    }
}