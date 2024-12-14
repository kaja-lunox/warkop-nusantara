<?php
// session_start();
require_once __DIR__ . '/../models/TransactionModel.php';

class TransactionController
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
    }

    public function getTransactions()
    {
        return $this->transactionModel->getTransactions();
    }
}
