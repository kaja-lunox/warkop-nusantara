<?php
session_start();
require_once __DIR__ . '/../models/MenuModel.php';

class AddMenuController {
    private $model;

    public function __construct() {
        $this->model = new MenuModel();
    }

    public function addMenu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menuName = $_POST['menu_name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
    
            if (isset($_FILES['menu_image'])) {
                $targetDir = '../storage/images/';
                $fileExtension = pathinfo($_FILES['menu_image']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $fileExtension;
                $targetFilePath = $targetDir . $fileName;
    
                move_uploaded_file($_FILES['menu_image']['tmp_name'], $targetFilePath);
    
                if ($this->model->addMenu($menuName, $description, $price, $fileName)) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Data menu berhasil ditambahkan'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Terjadi kesalahan saat menambahkan data menu'];
                }
            }
            header("Location: ../views/admin/home.php");
            exit();
        }
    }    
}

$controller = new AddMenuController();

$controller->addMenu();
?>
