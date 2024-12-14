<?php
// session_start();
require_once __DIR__ . '/../models/TransactionModel.php';

class ConfirmPaymentController
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
    }

    public function confirmPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $transaction_id = $_POST['transaction_id'];
            $status = $_POST['status'];

            if ($this->transactionModel->confirmPayment($transaction_id, $status)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Pembayaran berhasil dikonfirmasi'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Gagal memperbarui status pembayaran'];
            }

            header("Location: ../views/admin/transactions.php");
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ConfirmPaymentController();
    $controller->confirmPayment();
}