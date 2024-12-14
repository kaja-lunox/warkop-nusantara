<?php
// session_start();
require_once __DIR__ . '/../models/OrderModel.php';

class OrderController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function order()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menu_id = $_POST['menu_id'];
            $orderer_id = $_POST['orderer_id'] ?? NULL;
            $orderer_name = $_POST['orderer_name'];
            $quantity = $_POST['quantity'];
            $table_number = $_POST['table_number'];
            $status = "waiting confirmation";

            if ($this->orderModel->order($menu_id, $orderer_id, $orderer_name, $quantity, $table_number, $status)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Pesanan akan segera diproses'];
            }

            header("Location: ../orders.php");
            exit();
        }
    }

    public function getOrders($searchTerm = '') {
        return $this->orderModel->getOrders($searchTerm);
    }

    public function getOrderByUser() {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['id'];
            $orders = $this->orderModel->getOrderByUser($user_id);
            return $orders;
        } else {
            header("Location: ../index.php");
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new OrderController();
    $controller->order();
}