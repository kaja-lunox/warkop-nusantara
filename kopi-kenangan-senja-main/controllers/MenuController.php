<?php
// session_start();
require_once __DIR__ . '/../models/MenuModel.php';

class MenuController {
    private $model;

    public function __construct() {
        $this->model = new MenuModel();
    }

    public function getMenus() {
        return $this->model->getMenus();
    } 
}

$controller = new MenuController();
?>
