<?php
session_start();
require_once __DIR__ . '/../models/MenuModel.php';

class DeleteMenuController {
    private $model;

    public function __construct() {
        $this->model = new MenuModel();
    }

    public function deleteMenu() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->model->deleteMenu($id)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Data menu berhasil dihapus'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Terjadi kesalahan saat menghapus data menu'];
            }
            header("Location: ../views/admin/home.php");
            exit();
        }
    }  
}

$controller = new DeleteMenuController();

if (isset($_GET['id'])) {
    $controller->deleteMenu();
}
?>
