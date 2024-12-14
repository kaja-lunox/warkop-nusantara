<?php
// session_start();
require_once __DIR__ . '/../models/OrderModel.php';

class ConfirmOrderController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function confirmOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'];
            $status = $_POST['status'];

            if ($status === "process") {
                $this->orderModel->transaction($order_id);
            }

            if ($this->orderModel->confirmOrder($order_id, $status)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Status pesanan diperbarui'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Gagal memperbarui status pesanan'];
            }

            header("Location: ../views/admin/orders.php");
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ConfirmOrderController();
    $controller->confirmOrder();
}